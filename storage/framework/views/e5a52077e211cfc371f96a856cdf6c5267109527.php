<!DOCTYPE html>
<html lang="en" style="height: 100%">
    <head>
        <meta charset="utf-8" />
        <title><?php echo e($title ?? __('custom.bulls_cows')); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div>
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="<?php echo e(route('startGame')); ?>">New Game</a>
                    <a class="navbar-brand" href="<?php echo e(route('statistics')); ?>">Statistics</a>
                </div>
            </nav>
            <h1 class="text-center">Bulls and Cows</h1>

            <div class="row">
                <div class="input-group mb-5 col-md-2 col-3 mx-auto">
                    <div id="globalErrors" class="invalid-tooltip <?php echo e($errors->has('error') ? 'd-block' : ''); ?> col-3 text-center">
                        <?php echo e($errors->first('error')); ?>

                    </div>

                    <div id="globalSuccesses" class="valid-tooltip col-3 text-center"></div>
                </div>
            </div>
            
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    </body>
</html>
<?php /**PATH /mnt/c/Projects/game/resources/views/layout.blade.php ENDPATH**/ ?>