<?php

namespace System\Databases\Objects;

use System\Databases\BaseObject;

/**
 * Class Album
 * @package System\Databases\Objects
 * @method static Album[] getAll()
 * @method static Album getById($id)
 */
class Blog extends BaseObject
{
  protected static string $table = 'blogs';

  public ?int $id = null;
  public ?int $user_id = null;
  public string $title = '';
  public string $description = '';
  public string $image = '';
  public string $content = '';
  public string $featured = '';
  public int $impressions = 0;
  public string $created_at = '';
}
