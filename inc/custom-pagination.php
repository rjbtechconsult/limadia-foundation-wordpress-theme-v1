<?php
function custom_pagination($query) {
    $total_pages = $query->max_num_pages;
    $current_page = max(1, get_query_var('paged'));

    if ($total_pages > 1) : ?>
        <div class="row">
            <div class="col-sm-12">
                <nav>
                    <ul class="pagination theme-colored pull-right xs-pull-center mb-xs-40">
                        <!-- Previous Button -->
                        <?php if ($current_page > 1) : ?>
                            <li><a href="<?php echo get_pagenum_link($current_page - 1); ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                        <?php endif; ?>

                        <!-- Page Numbers -->
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) :
                            if ($i == $current_page) :
                                echo '<li class="active"><a href="#">' . $i . '</a></li>';
                            elseif ($i <= 5 || $i == $total_pages) :
                                echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
                            elseif ($i == 6) :
                                echo '<li><a href="#">...</a></li>';
                            endif;
                        endfor;
                        ?>

                        <!-- Next Button -->
                        <?php if ($current_page < $total_pages) : ?>
                            <li><a href="<?php echo get_pagenum_link($current_page + 1); ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    <?php endif;
}
