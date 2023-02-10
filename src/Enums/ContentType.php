<?php

namespace Illegal\Linky\Enums;

enum ContentType: string
{
    case Redirect = "redirect";
    case Collection = "collection";
    case Page = "page";
}
