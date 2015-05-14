<?php

namespace Silly\Web\HTML\Forms;

/**
 * Description of InputType
 *
 * @author Elton Schivei Costa
 */
class InputType extends \SplEnum
{

    const BUTTON         = "button";
    const CHECKBOX       = "checkbox";
    const COLOR          = "color";
    const DATE           = "date";
    const DATETIME       = "datetime";
    const DATETIME_LOCAL = "datetime-local";
    const EMAIL          = "email";
    const FILE           = "file";
    const HIDDEN         = "hidden";
    const IMAGE          = "image";
    const MONTH          = "month";
    const NUMBER         = "number";
    const PASSWORD       = "password";
    const RADIO          = "radio";
    const RANGE          = "range";
    const RESET          = "reset";
    const SEARCH         = "search";
    const SUBMIT         = "submit";
    const TEL            = "tel";
    const TEXT           = "text";
    const TIME           = "time";
    const URL            = "url";
    const WEEK           = "week";
    
    protected function __construct($initial_value = null, $strict = true)
    {
        parent::__construct($initial_value, $strict);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asButton()
    {
        return new InputType(self::BUTTON);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asCheckbox()
    {
        return new InputType(self::CHECKBOX);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asColor()
    {
        return new InputType(self::COLOR);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asDate()
    {
        return new InputType(self::DATE);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asDatetime()
    {
        return new InputType(self::DATETIME);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asDatetime_local()
    {
        return new InputType(self::DATETIME_LOCAL);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asEmail()
    {
        return new InputType(self::EMAIL);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asFile()
    {
        return new InputType(self::FILE);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asHidden()
    {
        return new InputType(self::HIDDEN);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asImage()
    {
        return new InputType(self::IMAGE);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asMonth()
    {
        return new InputType(self::MONTH);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asNumber()
    {
        return new InputType(self::NUMBER);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asPassword()
    {
        return new InputType(self::PASSWORD);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asRadio()
    {
        return new InputType(self::RADIO);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asRange()
    {
        return new InputType(self::RANGE);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asReset()
    {
        return new InputType(self::RESET);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asSearch()
    {
        return new InputType(self::SEARCH);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asSubmit()
    {
        return new InputType(self::SUBMIT);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asTel()
    {
        return new InputType(self::TEL);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asText()
    {
        return new InputType(self::TEXT);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asTime()
    {
        return new InputType(self::TIME);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asUrl()
    {
        return new InputType(self::URL);
    }

    /**
     * @return Silly\Web\HTML\Forms\InputType
     */
    public static function asWeek()
    {
        return new InputType(self::WEEK);
    }

}
