<?php

namespace Illegal\Linky\Enums;

enum ContentType: string
{
    case Link = "link";
    case Collection = "collection";
    case Page = "page";
}
