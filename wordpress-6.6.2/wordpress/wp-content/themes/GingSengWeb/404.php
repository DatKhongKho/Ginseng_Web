<?php get_header(); ?>

<div class="container text-center my-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <h1 class="display-1 text-primary font-weight-bold">404</h1>
            <h2 class="mb-4 text-dark">Oops! Trang bạn tìm kiếm không tồn tại.</h2>
            <p class="text-muted mb-4">
                Trang bạn đang cố truy cập không tồn tại, đã bị xóa hoặc đường dẫn không chính xác.
            </p>
            <a href="<?php echo home_url(); ?>" class="btn btn-primary px-4 py-2">Quay về trang chủ</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>