<?php

namespace Illegal\Linky\Enums;

enum ContentStatus: string
{
    case Draft = "draft";
    case Active = "active";
    case Archived = "archived";
}
