<?php if (isset($breadcrumbs)): ?>
<section class="main-container main-area">
    <div class="page-header single-line">
        <div class="row">
            <div class="col-md-6">
                <h2><?php echo $title ?></h2>
            </div>
            <div class="col-md-6">
                <ul class="list-page-breadcrumb">
                    <?php foreach ($breadcrumbs as $b => $breadcrumb): ?>
                        <?php if ($b == (count($breadcrumbs) - 1)): ?>
                            <li href="<?php echo $breadcrumb['url'] ?>" class="active-page"> <?php echo $breadcrumb['title'] ?></li>
                        <?php else: ?>
                            <li href="<?php echo $breadcrumb['url'] ?>"> <?php echo $breadcrumb['title'] ?> <i class="zmdi zmdi-chevron-right"></i></li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php endif ?>
