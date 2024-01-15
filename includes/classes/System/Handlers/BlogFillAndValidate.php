<?php

namespace System\Handlers;

use System\Form\Data;
use System\Form\Validation\BlogValidator;

/**
 * Trait AlbumFillAndValidate
 * @package System\Handlers
 */
trait BlogFillAndValidate
{
    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->blog->title = $this->formData->getPostVar('title');
            $this->blog->description = $this->formData->getPostVar('description');
            $this->blog->content = $this->formData->getPostVar('content');
            $this->blog->featured = $this->formData->getPostVar('featured');
            $this->blog->created_at = $this->formData->getPostVar('created_at');

            //Actual validation
            $validator = new BlogValidator($this->blog);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}
