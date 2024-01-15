<?php

namespace System\Form\Validation;

use System\Databases\Objects\Blog;

/**
 * Class AlbumValidator
 * @package System\Form\Validation
 */
class BlogValidator implements Validator
{
    private array $errors = [];

    /**
     * AlbumValidator constructor.
     *
     * @param Blog $blog
     */
    public function __construct(private readonly Blog $blog)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->blog->title == '') {
            $this->errors[] = 'Artist cannot be empty';
        }
        if ($this->blog->description == '') {
            $this->errors[] = 'Album cannot be empty';
        }
        if ($this->blog->content == '') {
            $this->errors[] = 'Genre cannot be empty';
        }
        if ($this->blog->created_at == '') {
            $this->errors[] = 'date cannot be empty';
        }
        if (!$this->blog->featured) {
            $this->blog->featured = 'false';
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
