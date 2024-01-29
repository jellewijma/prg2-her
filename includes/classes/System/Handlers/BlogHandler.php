<?php

namespace System\Handlers;

use System\Form\Data;
use System\Databases\Objects\Blog;
use System\Utils\Image;

/**
 * Class AlbumHandler
 * @package System\Handlers
 * @noinspection PhpUnused
 */
class BlogHandler extends BaseHandler
{
  use BlogFillAndValidate;

  private Blog $blog;
  private Data $formData;
  private Image $image;

  /**
   * AlbumHandler constructor.
   *
   * @param string $templateName
   * @throws \ReflectionException
   */
  public function __construct(string $templateName)
  {
    parent::__construct($templateName);
    $this->image = new Image();
  }

  protected function index(): void
  {
    //  Get all albums
    $blogs = Blog::getAll();

    //Return formatted data
    $this->renderTemplate([
      'pageTitle' => 'Home',
      'blogs' => $blogs
    ]);
  }

  protected function overview(): void
  {
    //  Get all albums
    $blogs = Blog::getAll();

    $this->renderTemplate([
      'pageTitle' => 'Overview',
      'blogs' => $blogs
    ]);
  }

  /**
   * @noinspection PhpUnused
   *
   * @return void
   */
  protected function blog(): void
  {
    try {
      //Get the records from the db
      $blog = Blog::getById((int)$_GET['id']);

      //Default page title
      $pageTitle = $blog->title;
    } catch (\Exception $e) {
      $this->logger->error($e);
      $this->errors[] = 'Something went wrong retrieving the album as it doesn\'t seem to exist.';
      $pageTitle = 'Album does\'t exist';
    }

    //Return formatted data
    $this->renderTemplate([
      'pageTitle' => $pageTitle,
      'blog' => $blog ?? null,
      'errors' => $this->errors
    ]);
  }
}
