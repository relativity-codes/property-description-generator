<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AI Property Description Enhancer - Generate compelling, SEO-optimized property descriptions effortlessly.">
    <title>AI Property Description Enhancer</title>
    <!-- Open Graph / Social -->
    <meta property="og:title" content="AI Property Description Enhancer" />
    <meta property="og:description" content="Generate SEO-optimized property descriptions with AI. Built with Laravel, Livewire & Tailwind." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo e(url('/')); ?>" />
    <meta property="og:image" content="<?php echo e(asset('logo.svg')); ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <style> /* small nicety for prose */
        .prose img{max-width:100%;}
    </style>
</head>
<body class="bg-gradient-to-b from-gray-50 to-white text-gray-800 antialiased">
    <!-- Hero -->
    <header class="bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500 text-white">
        <?php
            try {
                $openaiStatus = app(\App\Services\OpenAIService::class)->checkStatus();
            } catch (\Exception $e) {
                $openaiStatus = ['status' => 'error', 'message' => $e->getMessage()];
            }
        ?>
        <?php if(isset($openaiStatus['status']) && $openaiStatus['status'] !== 'ok'): ?>
            <div class="w-full text-sm text-center py-2 px-4" style="background: rgba(0,0,0,0.08);">
                <?php if($openaiStatus['status'] === 'no_key'): ?>
                    <div class="max-w-7xl mx-auto text-yellow-100">OpenAI: not configured — using local fallback. (<span class="font-semibold"><?php echo e($openaiStatus['message']); ?></span>)</div>
                <?php elseif($openaiStatus['status'] === 'quota'): ?>
                    <div class="max-w-7xl mx-auto text-yellow-100">OpenAI: quota exceeded — using local fallback. (<span class="font-semibold"><?php echo e($openaiStatus['message']); ?></span>)</div>
                <?php else: ?>
                    <div class="max-w-7xl mx-auto text-yellow-100">OpenAI: unavailable — using local fallback. (<span class="font-semibold"><?php echo e($openaiStatus['message']); ?></span>)</div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="max-w-7xl mx-auto px-6 py-20 lg:py-28 flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2 text-center lg:text-left">
                <div class="flex items-center justify-center lg:justify-start gap-3 mb-4">
                    <img src="<?php echo e(asset('logo.svg')); ?>" alt="Logo" class="w-10 h-10 rounded" />
                    <div class="text-left">
                        <div class="text-sm font-semibold">Dilmak Solutions</div>
                        <div class="text-xs text-indigo-100">Property Description Enhancer</div>
                    </div>
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight">AI Property Description Enhancer</h1>
                <p class="mt-4 text-indigo-100 max-w-xl mx-auto lg:mx-0">Write compelling, SEO-optimized property descriptions in seconds. Increase listing quality and engagement with tailored AI copy that sounds natural and professional.</p>
                <div class="mt-8 flex justify-center lg:justify-start gap-4">
                    <a href="#demo" class="inline-flex items-center gap-2 bg-white text-indigo-700 font-semibold py-3 px-5 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Try the demo</a>
                    <a href="#features" class="inline-flex items-center gap-2 border border-white/30 text-white py-3 px-4 rounded-lg hover:bg-white/10">How it works</a>
                </div>
                <p class="mt-6 text-sm text-indigo-100">Built with Laravel 11, Livewire 3 & Tailwind CSS — ready for interview demos.</p>
            </div>

            <div class="lg:w-1/2 flex justify-center">
                <!-- Illustration card -->
                <div class="w-full max-w-xl bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Live demo</h3>
                            <p class="text-sm text-gray-500 mt-1">Fill in a few details and generate a description instantly.</p>
                        </div>
                        <div class="text-sm text-gray-400">No API key required</div>
                    </div>
                    <div class="mt-4">
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('property-form');

$__html = app('livewire')->mount($__name, $__params, 'lw-2880789719-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Features -->
    <section id="features" class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-2xl font-bold text-center">Why it helps</h2>
        <p class="text-center mt-2 text-gray-600 max-w-2xl mx-auto">A quick tool for recruiters, content teams and agents to produce consistent, high-quality property descriptions that convert.</p>

        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">🏠</div>
                    <div>
                        <h3 class="font-semibold">AI-Powered Copy</h3>
                        <p class="text-sm text-gray-600 mt-1">Generate natural-sounding descriptions tuned for property listings.</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-cyan-50 text-cyan-600 rounded-lg">⚙️</div>
                    <div>
                        <h3 class="font-semibold">Fast Iteration</h3>
                        <p class="text-sm text-gray-600 mt-1">Regenerate alternate tones and tweak features quickly.</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-rose-50 text-rose-600 rounded-lg">🔍</div>
                    <div>
                        <h3 class="font-semibold">SEO-Focused</h3>
                        <p class="text-sm text-gray-600 mt-1">Output crafted to include location and feature keywords for better search visibility.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600">© <?php echo e(date('Y')); ?> Dilmak Solutions — AI Property Description Enhancer</div>
            <div class="flex items-center gap-4">
                <a href="#" class="text-gray-600 hover:text-gray-900">Documentation</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">GitHub</a>
            </div>
        </div>
    </footer>
</body>
</html><?php /**PATH /Users/macbookpro2015/Documents/Dilmak/interview/property-description-generator/resources/views/landing.blade.php ENDPATH**/ ?>