<div x-data="{ showToast: false, toastMessage: '' }" x-cloak class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <form wire:submit.prevent="generateDescription" class="space-y-4 text-gray-900">
        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" wire:model.defer="title" class="mt-1 block w-full rounded h-11 px-2 py-1 border border-gray-300" placeholder="e.g. Spacious 3-bedroom family home" />
            @error('title') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Property Type</label>
                <select wire:model.defer="propertyType" class="mt-1 block w-full rounded h-11 px-2 py-1 border border-gray-300">
                    <option value="">Select type</option>
                    <option>House</option>
                    <option>Flat</option>
                    <option>Land</option>
                    <option>Commercial</option>
                </select>
                @error('propertyType') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" wire:model.defer="location" class="mt-1 block w-full rounded h-11 px-2 py-1 border border-gray-300" placeholder="City, Neighbourhood" />
                @error('location') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Price (NGN)</label>
                <input type="number" wire:model.defer="price" class="mt-1 h-11 px-2 py-1 block w-full rounded border border-gray-300" placeholder="e.g. 5000000" />
                @error('price') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">&nbsp;</label>
                <div class="mt-1 text-sm text-gray-500">Leave blank to keep default features</div>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Key Features</label>
            <textarea wire:model.defer="keyFeatures" rows="3" class="mt-1 block w-full h-24 px-2 py-1 rounded border border-gray-300" placeholder="Separate features with commas"></textarea>
            @error('keyFeatures') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tone</label>
            <select wire:model="tone" class="mt-1 block w-full h-11 px-2 py-1 rounded border border-gray-300">
                <option>Formal</option>
                <option>Casual</option>
                <option>Luxury</option>
            </select>
            @error('tone') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded flex items-center gap-2 cursor-pointer" wire:loading.attr="disabled">
                <svg wire:loading.class="animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                <span>Generate Description</span>
            </button>

            <button type="button" wire:click="regenerateDescription" class="px-4 py-2 bg-gray-100 rounded flex items-center gap-2 cursor-pointer" wire:loading.attr="disabled">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4v6h6"/><path d="M16 16V10H10"/></svg>
                <span>Regenerate</span>
            </button>

            <button type="button" @click="navigator.clipboard.writeText(document.getElementById('generated-output').innerText); showToast = true; toastMessage = 'Copied to clipboard'; setTimeout(() => showToast = false, 2500)" class="px-4 py-2 bg-emerald-600 text-white rounded flex items-center gap-2 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M8 2a2 2 0 00-2 2v2H5a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2v-1h1a2 2 0 002-2V8a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H8z"/></svg>
                <span>Copy</span>
            </button>
        </div>
    </form>

    <div class="mt-6">
        <!-- Toast -->
        <div x-show="showToast" x-transition.opacity.duration.200ms class="fixed bottom-6 right-6 bg-black text-white px-4 py-2 rounded shadow z-50" style="display:none" x-text="toastMessage"></div>

        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">Generated Description</h2>
            @if($seoScore !== null)
                <div class="text-sm text-gray-600">SEO Score: <span class="font-semibold">{{ $seoScore }}%</span></div>
            @endif
        </div>

        <div class="mt-2 p-4 bg-gray-50 rounded min-h-[6rem]" id="generated-output">
            @if($description)
                <div class="prose max-w-none text-gray-800">{!! nl2br(e($description)) !!}</div>
            @else
                <div class="text-sm text-gray-500">No description generated yet. Fill the form and click "Generate Description".</div>
            @endif
        </div>
    </div>
</div>
