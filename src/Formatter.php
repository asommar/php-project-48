<?php

namespace Differ\Formatter;

function formatResult(array $diff): string
{
    return \Differ\Formatters\Stylish\formatResult($diff);
}
