<?php
function testSwitchStatementHasExpectedEndColumn()
{
    switch ($x && $y || $z) {
        case true: break;
        case false: break;
        default: break;
    }
}