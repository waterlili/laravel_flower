<?php
$page = new \App\View\PageGenerator();

$title = new \App\View\InputObject('data.title', trans('field.title'));
$url = new \App\View\InputObject('data.url', trans('field.url'));
$title->setRequired(true);
$grid = new \App\View\Grid();
$grid_url = new \App\View\Grid();
$grid_url->grid(30, 60);
$grid_url->inc(0, 'MD.input.text', $url->export());
$grid->inc(0, 'MD.input.date_text', ['name' => 'updated_at', 'model' => 'data.updated_at'], true);
$page->inc('MD.input.text', $title->export());
$page->addGrid($grid_url);
$page->inc('MD.input.chkeditor', ['model' => 'data.body', 'title' => trans('field.body'), 'options' => 'options']);
$page->addGrid($grid);

if (isset($edt)) {
    $page->setSubmit(NULL);
}
?>


<section class="w-box p-md">
    {!!  $page->render() !!}
</section>