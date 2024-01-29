<?php
?>
<div class=" relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg md:my-16 md:max-w-xl lg:max-w-2xl xl:max-w-[70vw]">
        <?php if (isset($blog)) : ?>
          <form class="p-6" action="" method="post" enctype="multipart/form-data">
            <div class="space-y-6">
              <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Blog post</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                  <div class="col-span-full">
                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                    <div class="mt-2">
                      <input type="text" id="title" name="title" value="<?= $blog->title; ?>" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                  </div>
                  <div class="col-span-full">
                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                    <div class="mt-2">
                      <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $blog->description; ?></textarea>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-gray-600">Write a short description about the subject.</p>
                  </div>

                  <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Cover photo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                      <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                        </svg>
                        <div class="mt-4 flex text-sm leading-6 text-gray-600">
                          <label for="image" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span>Upload a file</span>
                            <input id="image" name="image" type="file" class="sr-only">
                          </label>
                          <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-full">
                    <label for="content" class="block text-sm font-medium leading-6 text-gray-900">Content</label>
                    <div class="mt-2">
                      <textarea id="content" name="content" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $blog->content; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" name="created_at" id="created_at" value="<?php echo date('y-m-d'); ?>" readonly="readonly">
              <?php echo date('Y-m-d'); ?>
              <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Settings</h2>

                <div class="mt-5">
                  <fieldset>
                    <legend class="text-sm font-semibold leading-6 text-gray-900">Featured</legend>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Get more impresions by putting this blog post on the front page.</p>
                    <div class="mt-6 space-y-6">
                      <div class="flex items-center gap-x-3">
                        <input id="featured-on" name="featured" type="radio" value="true" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" <?php if ($blog->featured == 'true') {
                                                                                                                                                                  echo 'checked';
                                                                                                                                                                } ?>>
                        <label for="featured-on" class="block text-sm font-medium leading-6 text-gray-900">Featured On</label>
                      </div>
                      <div class="flex items-center gap-x-3">
                        <input id="featured-off" name="featured" type="radio" value="false" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" <?php if ($blog->featured == 'false') {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                  } ?>>
                        <label for="featured-off" class="block text-sm font-medium leading-6 text-gray-900">Featured Off</label>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
              <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
              <button type="submit" value="submit" name="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
          </form>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>