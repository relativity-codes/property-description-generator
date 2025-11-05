<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

/**
 * Lightweight OpenAI service wrapper.
 *
 * - If OPENAI_API_KEY is set, it will attempt to call OpenAI's chat completions API
 *   (compatible endpoint). If not available, it returns a deterministic fallback
 *   based on the provided inputs so the app remains usable offline.
 */
class OpenAIService
{
    public function generateDescription(array $data, array $options = []) : string
    {
        // Use centralized config values (config/openai.php)
        $apiKey = config('openai.api_key');
        $url = config('openai.url');
        $model = config('openai.model');

        $prompt = $this->buildPrompt($data, $options);

        if (empty($apiKey)) {
            // Fallback deterministic generation when no API key is configured.
            return $this->fallbackGenerate($data, $options);
        }

        // Try calling the OpenAI-compatible endpoint. This uses Http facade.
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post($url, [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a professional copywriter specialized in real estate listings for Nigeria. Produce SEO-optimized, natural property descriptions.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => !empty($options['alternate']) ? 0.85 : 0.6,
                'max_tokens' => 400,
            ]);

            if ($response->successful()) {
                $json = $response->json();
                // Support both OpenAI and compatible API shapes
                $text = $json['choices'][0]['message']['content'] ?? ($json['choices'][0]['text'] ?? null);
                return trim($text ?? $this->fallbackGenerate($data, $options));
            } else {
                // Log unsuccessful responses for diagnostics
                Log::error('OpenAI API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'url' => $url,
                ]);
                $fallback = $this->fallbackGenerate($data, $options);
                return $fallback . "\n\n[Notice: OpenAI API returned status " . $response->status() . "; using local fallback. Check logs for details.]";
            }
        } catch (\Exception $e) {
            // On any failure, log exception and return fallback so UI remains functional.
            Log::error('OpenAI API exception', ['exception' => $e->getMessage()]);
            $fallback = $this->fallbackGenerate($data, $options);
            return $fallback . "\n\n[Notice: OpenAI API request failed with exception; using local fallback. Check logs for details.]";
        }

        return $this->fallbackGenerate($data, $options);
    }

    /**
     * Check OpenAI availability and quota status.
     * Result is cached for 5 minutes to avoid repeated network calls during page loads.
     * Returns array: ['status' => 'ok'|'quota'|'no_key'|'error', 'message' => string]
     */
    public function checkStatus(): array
    {
        return Cache::remember('openai.status', 300, function () {
            $apiKey = config('openai.api_key');
            $url = config('openai.url');
            $model = config('openai.model');

            if (empty($apiKey)) {
                return ['status' => 'no_key', 'message' => 'OpenAI API key not configured — using local fallback.'];
            }

            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ])->timeout(5)->post($url, [
                    'model' => $model,
                    'messages' => [
                        ['role' => 'system', 'content' => 'Health check.'],
                        ['role' => 'user', 'content' => 'Ping'],
                    ],
                    'max_tokens' => 5,
                ]);

                if ($response->successful()) {
                    return ['status' => 'ok', 'message' => 'OpenAI API reachable.'];
                }

                $json = $response->json();
                $error = $json['error']['message'] ?? $response->body();
                if ($response->status() == 429 || ($json['error']['code'] ?? '') === 'insufficient_quota') {
                    return ['status' => 'quota', 'message' => 'OpenAI quota exceeded: ' . ($error ?? 'quota')];
                }

                return ['status' => 'error', 'message' => 'OpenAI error: ' . ($error ?? 'unknown')];
            } catch (\Exception $e) {
                Log::warning('OpenAI status check failed: ' . $e->getMessage());
                return ['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()];
            }
        });
    }

    protected function buildPrompt(array $data, array $options = []) : string
    {
        $parts = [];
        $parts[] = "Title: " . ($data['title'] ?? '');
        $parts[] = "Type: " . ($data['property_type'] ?? '');
        $parts[] = "Location: " . ($data['location'] ?? '');
        $parts[] = "Price: " . ($data['price'] ?? '');
        $parts[] = "Key features: " . ($data['key_features'] ?? '');

        if (!empty($data['tone'])) {
            $parts[] = "Tone: " . $data['tone'];
        }

        $prompt = "Write a concise, SEO-optimized property description (2-4 short paragraphs) for the listing using the details below. Use natural, professional language, include location and key features, and make it friendly to prospective buyers.\n\n";
        $prompt .= implode("\n", $parts);
        $prompt .= "\n\nIf asked for an alternate version, vary tone and wording while keeping facts the same.";

        return $prompt;
    }

    protected function fallbackGenerate(array $data, array $options = []) : string
    {
        $type = $data['property_type'] ?? 'Property';
        $location = $data['location'] ?? 'this location';
        $price = isset($data['price']) ? number_format($data['price']) : 'contact for price';
        $features = $data['key_features'] ?? '';
        $tone = strtolower($data['tone'] ?? 'formal');

        // Adjust phrasing slightly based on tone
        if ($tone === 'casual') {
            $lead = "Check out this great {$type} in {$location}.";
            $body = $features ? "You'll love: {$features}." : "Great value and a handy location.";
            $cta = "At ₦{$price}, it's worth a look — get in touch to arrange a viewing.";
        } elseif ($tone === 'luxury') {
            $lead = "An exquisite {$type} positioned in the heart of {$location}.";
            $body = $features ? "Standout features include: {$features}." : "A prestigious property offering refined living and exceptional finishes.";
            $cta = "Offered at ₦{$price}, this is an exclusive opportunity — contact us for private viewings.";
        } else {
            $lead = "Introducing a lovely {$type} in {$location}.";
            $body = $features ? "Key features include: {$features}." : "This listing offers excellent value and a convenient location.";
            $cta = "Priced at ₦{$price}, this listing is perfect for buyers seeking value and comfort. Contact the agent for viewing details.";
        }

        if (!empty($options['alternate'])) {
            // Slightly different phrasing for alternate versions
            return "A well-presented {$type} located in {$location}. {$body} {$cta}";
        }

        return "{$lead} {$body} {$cta}";
    }
}
