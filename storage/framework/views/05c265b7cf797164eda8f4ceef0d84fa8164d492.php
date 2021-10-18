<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="mx-auto">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><?php echo e(__('custom.number')); ?></span>
            </div>
            <input id="numberGuess" type="text" class="form-control" required />
            <button id="checkNumber" type="button" class="btn btn-primary ml-1"><?php echo e(__('custom.guess')); ?></button>
        </div>

        <h3 class="text-center">Previous Guesses</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col"><?php echo e(__('custom.number')); ?></th>
                <th scope="col"><?php echo e(__('custom.bulls')); ?></th>
                <th scope="col"><?php echo e(__('custom.cows')); ?></th>
                </tr>
            </thead>
            <tbody id="previousGuessesBody">
                <tr id="guessExample" hidden>
                    <td class="guessNumber"></td>
                    <td class="guessBulls"></td>
                    <td class="guessCows"></td>
                </tr>
                <?php $__currentLoopData = $game->gameGuesses->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gameGuess): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($gameGuess->number); ?></td>
                        <td><?php echo e($gameGuess->bulls); ?></td>
                        <td><?php echo e($gameGuess->cows); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        </div>
    </div>

    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', ['title' => __('custom.play_game')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/Projects/game/resources/views/game.blade.php ENDPATH**/ ?>