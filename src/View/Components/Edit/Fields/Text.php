<?php

declare(strict_types=1);

namespace Mvc\View\Components\Edit\Fields;

use Mvc\View\Components\Base\Fields\AbstractText;
use Mvc\View\Components\Base\RequiredAwareInterface;
use Mvc\View\Components\Base\RequiredAwareTrait;

class Text extends AbstractText implements RequiredAwareInterface
{
    use RequiredAwareTrait;

    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_TEXT = 'text';
    public const TYPE_HIDDEN = 'hidden';
    public const TYPE_URL = 'url';
    public const TYPE_TEL = 'tel';

    public const AUTOCOMPLETE_OFF = 'off';
    public const AUTOCOMPLETE_ON = 'on';
    public const AUTOCOMPLETE_NAME = 'name';
    public const AUTOCOMPLETE_HONORIFIC_PREFIX = 'honorific-prefix';
    public const AUTOCOMPLETE_GIVEN_NAME = 'given-name';
    public const AUTOCOMPLETE_ADDITIONAL_NAME = 'additional-name';
    public const AUTOCOMPLETE_FAMILY_NAME = 'family-name';
    public const AUTOCOMPLETE_HONORIFIC_SUFFIX = 'honorific-suffix';
    public const AUTOCOMPLETE_NICKNAME = 'nickname';
    public const AUTOCOMPLETE_EMAIL = 'email';
    public const AUTOCOMPLETE_USERNAME = 'username';
    public const AUTOCOMPLETE_NEW_PASSWORD = 'new-password';
    public const AUTOCOMPLETE_CURRENT_PASSWORD = 'current-password';
    public const AUTOCOMPLETE_ONE_TIME_CODE = 'one-time-code';
    public const AUTOCOMPLETE_ORGANIZATION_TITLE = 'organization-title';
    public const AUTOCOMPLETE_ORGANIZATION = 'organization';
    public const AUTOCOMPLETE_STREET_ADDRESS = 'street-address';
    public const AUTOCOMPLETE_ADDRESS_LINE1 = 'address-line1';
    public const AUTOCOMPLETE_ADDRESS_LINE2 = 'address-line2';
    public const AUTOCOMPLETE_ADDRESS_LINE3 = 'address-line3';
    public const AUTOCOMPLETE_ADDRESS_LEVEL4 = 'address-level4';
    public const AUTOCOMPLETE_ADDRESS_LEVEL3 = 'address-level3';
    public const AUTOCOMPLETE_ADDRESS_LEVEL2 = 'address-level2';
    public const AUTOCOMPLETE_ADDRESS_LEVEL1 = 'address-level1';
    public const AUTOCOMPLETE_COUNTRY = 'country';
    public const AUTOCOMPLETE_COUNTRY_NAME = 'country-name';
    public const AUTOCOMPLETE_POSTAL_CODE = 'postal-code';
    public const AUTOCOMPLETE_CREDIT_CARD_NAME = 'cc-name';
    public const AUTOCOMPLETE_CREDIT_CARD_GIVEN_NAME = 'cc-given-name';
    public const AUTOCOMPLETE_CREDIT_CARD_ADDITIONAL_NAME = 'cc-additional-name';
    public const AUTOCOMPLETE_CREDIT_CARD_FAMILY_NAME = 'cc-family-name';
    public const AUTOCOMPLETE_CREDIT_CARD_NUMBER = 'cc-number';
    public const AUTOCOMPLETE_CREDIT_CARD_EXP = 'cc-exp';
    public const AUTOCOMPLETE_CREDIT_CARD_EXP_MONTH = 'cc-exp-month';
    public const AUTOCOMPLETE_CREDIT_CARD_EXP_YEAR = 'cc-exp-year';
    public const AUTOCOMPLETE_CREDIT_CARD_CSC = 'cc-csc';
    public const AUTOCOMPLETE_CREDIT_CARD_TYPE = 'cc-type';
    public const AUTOCOMPLETE_TRANSACTION_CURRENCY = 'transaction-currency';
    public const AUTOCOMPLETE_TRANSACTION_AMOUNT = 'transaction-amount';
    public const AUTOCOMPLETE_LANGUAGE = 'language';
    public const AUTOCOMPLETE_BIRTHDAY = 'bday';
    public const AUTOCOMPLETE_BIRTHDAY_DAY = 'bday-day';
    public const AUTOCOMPLETE_BIRTHDAY_MONTH = 'bday-month';
    public const AUTOCOMPLETE_BIRTHDAY_YEAR = 'bday-year';
    public const AUTOCOMPLETE_SEX = 'sex';
    public const AUTOCOMPLETE_TEL = 'tel';
    public const AUTOCOMPLETE_TEL_COUNTRY_CODE = 'tel-country-code';
    public const AUTOCOMPLETE_TEL_NATIONAL = 'tel-national';
    public const AUTOCOMPLETE_TEL_AREA_CODE = 'tel-area-code';
    public const AUTOCOMPLETE_TEL_LOCAL = 'tel-local';
    public const AUTOCOMPLETE_TEL_EXTENSION = 'tel-extension';
    public const AUTOCOMPLETE_IMPP = 'impp';
    public const AUTOCOMPLETE_URL = 'url';
    public const AUTOCOMPLETE_PHOTO = 'photo';


    /**
     * @var string
     */
    private $hint;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $autocomplete;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/edit/fields/text';
    }

    /**
     * @return string
     */
    public function getHint(): string
    {
        return $this->hint;
    }

    /**
     * @param string $hint
     *
     * @return $this
     */
    public function setHint(string $hint): self
    {
        $this->hint = $hint;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasHint(): bool
    {
        return $this->hint !== null;
    }


    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type ?? self::TYPE_TEXT;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getAutocomplete(): string
    {
        return $this->autocomplete ?? self::AUTOCOMPLETE_OFF;
    }

    /**
     * @param string $autocomplete
     *
     * @return $this
     */
    public function setAutocomplete(string $autocomplete): self
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }
}
