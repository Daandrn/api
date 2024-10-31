<?php 

namespace Config;

require __DIR__ . '/vendor/autoload.php';

trait Env_example
{
    private const DRIVE     = 'pgsql';
    private const HOST      = 'localhost';
    private const DATA_BASE = 'postgres';
    private const USER      = 'postgres';
    private const PASSWORD  = '';
}
