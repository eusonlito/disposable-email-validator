<?php
namespace Eusonlito\DisposableEmail;

class Check
{
    /**
     * @param string $email
     *
     * @return bool
     */
    public static function email($email)
    {
        if (!static::emailFilter($email)) {
            return false;
        }

        return static::domain(explode('@', $email)[1]);
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public static function emailFilter($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public static function emailExpression($email)
    {
        return (bool)preg_match('/^[a-z0-9_\-\.]+(\+[a-z0-9_\-\.]+)*@[a-z0-9_\-\.]+\.[a-z]{2,6}$/i', $email);
    }

    /**
     * @param string $domain
     *
     * @return bool
     */
    public static function domain($domain)
    {
        $fp = fopen(static::data('domains'), 'r');

        while (($row = fgets($fp, 1024)) !== false) {
            if ($domain === trim($row)) {
                return false;
            }
        }

        fclose($fp);

        return static::wildcard($domain);
    }

    /**
     * @param string $domain
     *
     * @return bool
     */
    public static function wildcard($domain)
    {
        $domain = implode('.', array_slice(explode('.', $domain), -2));
        $fp = fopen(static::data('wildcards'), 'r');

        while (($row = fgets($fp, 1024)) !== false) {
            if ($domain === trim($row)) {
                return false;
            }
        }

        fclose($fp);

        return true;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    private static function data($name)
    {
        return dirname(__DIR__).'/data/'.$name.'.txt';
    }
}
