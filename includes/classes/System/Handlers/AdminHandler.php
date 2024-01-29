<?php

namespace System\Handlers;

use System\Form\Data;
use System\Databases\Objects\Blog;
use System\Utils\Image;

/**
 * Class BlogHandler
 * @package System\Handlers
 * @noinspection PhpUnused
 */
class AdminHandler extends BaseHandler
{
  use BlogFillAndValidate;

  private Blog $blog;
  private Data $formData;
  private Image $image;

  /**
   * BlogHandler constructor.
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
    //If not logged in, redirect to login
    if (!$this->session->keyExists('user')) {
      header('Location: login');
      exit;
    }

    //Set default empty Blog & execute POST logic
    $this->blog = new Blog();
    $this->executePostHandler();

    //Special check for create form only
    if (isset($this->formData) && $_FILES['image']['error'] == 4) {
      $this->errors[] = 'Image cannot be empty';
    }

    //Database magic when no errors are found
    if (isset($this->formData) && empty($this->errors)) {
      //Store image & retrieve name for database saving
      $this->blog->image = $this->image->save($_FILES['image']);

      //Set user id in Blog
      $this->blog->user_id = $this->session->get('user')->id;

      //Save the record to the db
      if ($this->blog->save()) {
        $success = 'Blog succesfuly uploaded!';
        //Override to see a new empty form
        $this->blog = new Blog();
      } else {
        $this->errors[] = 'Whoops, something went wrong creating the blog';
      }
    }

    // Get all Blogs
    $blogs = Blog::getAll();

    //Return formatted data
    $this->renderTemplate([
      'pageTitle' => 'Home',
      'success' => $success ?? false,
      'errors' => $this->errors,
      'blog' => $this->blog,
      'blogs' => $blogs,
    ]);
  }

  protected function edit(): void
  {
    //If not logged in, redirect to login
    if (!$this->session->keyExists('user')) {
      header('Location: login');
      exit;
    }
    try {
      //Get the record from the db & execute POST logic
      $this->blog = Blog::getById((int)$_GET['id']);
      $this->executePostHandler();

      //Database magic when no errors are found
      if (isset($this->formData) && empty($this->errors)) {
        //If image is not empty, process the new image file
        if ($_FILES['image']['error'] != 4) {
          //Remove old image
          $this->image->delete($this->blog->image);

          //Store new image & retrieve name for database saving (override current image name)
          $this->blog->image = $this->image->save($_FILES['image']);
        }

        //Save the record to the db
        if ($this->blog->save()) {
          $success = 'Your blog has been updated in the database!';
          header('Location: ./admin');
        } else {
          $this->errors[] = 'Whoops, something went wrong updating the blog';
        }
      }

      $pageTitle = 'Edit ' . $this->blog->title;
    } catch (\Exception $e) {
      $this->logger->error($e);
      $this->errors[] = 'Something went wrong retrieving the album as it doesn\'t seem to exist.';
      $pageTitle = 'Album does\'t exist';
    }

    //Return formatted data
    $this->renderTemplate([
      'pageTitle' => $pageTitle,
      'blog' => $this->blog ?? null,
      'success' => $success ?? false,
      'errors' => $this->errors
    ]);
  }


  // /**
  //  * @noinspection PhpUnused
  //  *
  //  * @return void
  //  */
  // protected function detail(): void
  // {
  //   try {
  //     //Get the records from the db
  //     $album = Album::getById((int)$_GET['id']);

  //     //Default page title
  //     $pageTitle = $album->name;
  //   } catch (\Exception $e) {
  //     $this->logger->error($e);
  //     $this->errors[] = 'Something went wrong retrieving the album as it doesn\'t seem to exist.';
  //     $pageTitle = 'Album does\'t exist';
  //   }

  //   //Return formatted data
  //   $this->renderTemplate([
  //     'pageTitle' => $pageTitle,
  //     'album' => $album ?? null,
  //     'errors' => $this->errors
  //   ]);
  // }

  protected function delete(): void
  {
    try {
      //Get the record from the db
      $blog = Blog::getById($_GET['id']);

      //Only execute delete when confirmed
      if (isset($_GET['continue'])) {
        //Delete in the DB, and if successful remove image as well
        if (Blog::delete((int)$_GET['id'])) {
          //Remove image
          $this->image->delete($blog->image);

          //Redirect to homepage after deletion & exit script
          header('Location: ./admin');
          exit;
        }
      }

      //Return formatted data
      $this->renderTemplate([
        'pageTitle' => 'Delete album',
        'blog' => $blog,
        'errors' => $this->errors
      ]);
    } catch (\Exception $e) {
      //We don't want anyone sniffing the delete page for no reason, so without correct parameters, return back
      $this->logger->error($e);
      header('Location: ./admin');
      exit;
    }
  }
}
