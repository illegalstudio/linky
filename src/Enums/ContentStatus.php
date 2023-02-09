<?php

namespace Illegal\Linky\Enums;

enum ContentStatus: string
{
    case Draft = "draft";
    case Published = "published";
    case Archived = "archived";
}
