<ul class="collapsible collapsible-accordion collection with-header" data-collapsible="accordion">
    <li class="collection-header cyan">
        <h4 class="task-card-title">My Task</h4>
        <p class="task-card-date"><?php echo date('F d, Y'); ?></p>
    </li>

    <?php
    foreach ($enquiry as $val) {
        ?>
        <li class="">
            <div class="collapsible-header"><?php echo $val->enquiry_title . ' ' . (($val->status == 1) ? '<span class="task-cat teal">Open</span>' : '<span class="task-cat pink">Closed</span>'); ?>
                <a href="#" class="secondary-content"><i class="mdi-editor-border-color"></i></a>
                <a href="#" class="secondary-content"><i class="mdi-action-launch"></i></a>
            </div>
            <div class="collapsible-body" style="display: none;">
                <p><?php echo $val->enquiry_text; ?></p>
            </div
        </li>

        <?php
    }
    ?>
</ul>