<?php $__env->startSection('content'); ?>
    <div class="d-flex">
        <div class="col-md-5">
            <h3 class="text-center">Best Score Games</h3>
            <h6 class="text-center">Bulls = 10 score; Cows = 1 score</h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Rank</th>
                        <th scope="col">#GameID</th>
                        <th scope="col">GameNumber</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $bestScores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index + 1); ?></td>
                            <td><?php echo e($row->game_id); ?></td>
                            <td><?php echo e($row->game->number); ?></td>
                            <td><?php echo e($row->game->user->nickname); ?></td>
                            <td><?php echo e($row->score); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-5">
            <h3 class="text-center">Nicknames with most wins</h3>
            <h6 class="text-center">shows best 10 nicknames</h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Rank</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">Wins</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $mostWinsByNickname; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index + 1); ?></td>
                            <td><?php echo e($row->nickname); ?></td>
                            <td><?php echo e($row->wins); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', ['title' => __('custom.play_game')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/Projects/game/resources/views/statistics.blade.php ENDPATH**/ ?>