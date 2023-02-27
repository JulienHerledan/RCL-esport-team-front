<?php

namespace App\Service;

class Slugger
{

  public function sluggify(string $string): string
  {
    // Strip_tags is used to remove HTML and PHP tags.
    // Even tho pre_replace would remove chevrons, it won't remove the content of the tags
    // It does not delete the container content, and this content may contain malicious code.
    // This is the purpose of strip_tags.
    return preg_replace(
      ['/[^a-z0-9-]+/', '/-+/'],
      '-',
      strtolower(trim(strip_tags(str_replace('.', '', $string))))
    );
  }

}
