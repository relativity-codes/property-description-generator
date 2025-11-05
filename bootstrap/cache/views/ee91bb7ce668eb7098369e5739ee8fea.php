<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Description Generator</title>
    <!--[if BLOCK]><![endif]--><?php if(file_exists(public_path('mix-manifest.json'))): ?>
        <link href="<?php echo e(mix('css/app.css')); ?>" rel="stylesheet">
    <?php else: ?>
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Generate Property Description</h1>
        
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('property-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3163653386-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

        <footer class="mt-8 text-center">
            <p class="text-gray-600">© <?php echo e(date('Y')); ?> Nigeria Property Centre</p>
        </footer>
    </div>

    <!--[if BLOCK]><![endif]--><?php if(file_exists(public_path('mix-manifest.json'))): ?>
        <script src="<?php echo e(mix('js/app.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html><?php /**PATH /Users/macbookpro2015/Documents/Dilmak/interview/property-description-generator/resources/views/property-form.blade.php ENDPATH**/ ?>