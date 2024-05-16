<?php

use WireUi\View\Components;

return [
    /*
        |--------------------------------------------------------------------------
        | Icons
        |--------------------------------------------------------------------------
        |
        | The icons config will be used in icon component as default
        | https://heroicons.com
        |
    */
    'icons' => [
        'style' => env('WIREUI_ICONS_STYLE', 'outline'),
    ],

    /*
        |--------------------------------------------------------------------------
        | Modal
        |--------------------------------------------------------------------------
        |
        | The default modal preferences
        |
    */
    'modal' => [
        'zIndex' => env('WIREUI_MODAL_Z_INDEX', 'z-50'),
        'maxWidth' => env('WIREUI_MODAL_MAX_WIDTH', '2xl'),
        'spacing' => env('WIREUI_MODAL_SPACING', 'p-4'),
        'align' => env('WIREUI_MODAL_ALIGN', 'start'),
        'blur' => env('WIREUI_MODAL_BLUR', false),
    ],

    /*
        |--------------------------------------------------------------------------
        | Card
        |--------------------------------------------------------------------------
        |
        | The default card preferences
        |
    */
    'card' => [
        'padding' => env('WIREUI_CARD_PADDING', 'px-2 py-5 md:px-4'),
        'shadow' => env('WIREUI_CARD_SHADOW', 'shadow-md'),
        'rounded' => env('WIREUI_CARD_ROUNDED', 'rounded-lg'),
        'color' => env('WIREUI_CARD_COLOR', 'bg-white dark:bg-secondary-800'),
    ],

    /*
        |--------------------------------------------------------------------------
        | Components
        |--------------------------------------------------------------------------
        |
        | List with WireUI components.
        | Change the alias to call the component with a different name.
        | Extend the component and replace your changes in this file.
        | Remove the component from this file if you don't want to use.
        |
     */
    'components' => [
        'avatar' => [
            'class' => Components\Avatar::class,
            'alias' => 'wire-avatar',
        ],
        'icon' => [
            'class' => Components\Icon::class,
            'alias' => 'wire-icon',
        ],
        'icon.spinner' => [
            'class' => Components\Icons\Spinner::class,
            'alias' => 'wire-icon.spinner',
        ],
        'color-picker' => [
            'class' => Components\ColorPicker::class,
            'alias' => 'wire-color-picker',
        ],
        'input' => [
            'class' => Components\Input::class,
            'alias' => 'wire-input',
        ],
        'textarea' => [
            'class' => Components\Textarea::class,
            'alias' => 'wire-textarea',
        ],
        'label' => [
            'class' => Components\Label::class,
            'alias' => 'wire-label',
        ],
        'error' => [
            'class' => Components\Error::class,
            'alias' => 'wire-error',
        ],
        'errors' => [
            'class' => Components\Errors::class,
            'alias' => 'wire-errors',
        ],
        'inputs.maskable' => [
            'class' => Components\Inputs\MaskableInput::class,
            'alias' => 'wire-inputs.maskable',
        ],
        'inputs.phone' => [
            'class' => Components\Inputs\PhoneInput::class,
            'alias' => 'wire-inputs.phone',
        ],
        'inputs.currency' => [
            'class' => Components\Inputs\CurrencyInput::class,
            'alias' => 'wire-inputs.currency',
        ],
        'inputs.number' => [
            'class' => Components\Inputs\NumberInput::class,
            'alias' => 'wire-inputs.number',
        ],
        'inputs.password' => [
            'class' => Components\Inputs\PasswordInput::class,
            'alias' => 'wire-inputs.password',
        ],
        'badge' => [
            'class' => Components\Badge::class,
            'alias' => 'wire-badge',
        ],
        'badge.circle' => [
            'class' => Components\CircleBadge::class,
            'alias' => 'wire-badge.circle',
        ],
        'button' => [
            'class' => Components\Button::class,
            'alias' => 'wire-button',
        ],
        'button.circle' => [
            'class' => Components\CircleButton::class,
            'alias' => 'wire-button.circle',
        ],
        'dropdown' => [
            'class' => Components\Dropdown::class,
            'alias' => 'wire-dropdown',
        ],
        'dropdown.item' => [
            'class' => Components\Dropdown\DropdownItem::class,
            'alias' => 'wire-dropdown.item',
        ],
        'dropdown.header' => [
            'class' => Components\Dropdown\DropdownHeader::class,
            'alias' => 'wire-dropdown.header',
        ],
        'notifications' => [
            'class' => Components\Notifications::class,
            'alias' => 'wire-notifications',
        ],
        'datetime-picker' => [
            'class' => Components\DatetimePicker::class,
            'alias' => 'wire-datetime-picker',
        ],
        'time-picker' => [
            'class' => Components\TimePicker::class,
            'alias' => 'wire-time-picker',
        ],
        'card' => [
            'class' => Components\Card::class,
            'alias' => 'wire-card',
        ],
        'native-select' => [
            'class' => Components\NativeSelect::class,
            'alias' => 'wire-native-select',
        ],
        'select' => [
            'class' => Components\Select::class,
            'alias' => 'wire-select',
        ],
        'select.option' => [
            'class' => Components\Select\Option::class,
            'alias' => 'wire-select.option',
        ],
        'select.user-option' => [
            'class' => Components\Select\UserOption::class,
            'alias' => 'wire-select.user-option',
        ],
        'toggle' => [
            'class' => Components\Toggle::class,
            'alias' => 'wire-toggle',
        ],
        'checkbox' => [
            'class' => Components\Checkbox::class,
            'alias' => 'wire-checkbox',
        ],
        'radio' => [
            'class' => Components\Radio::class,
            'alias' => 'wire-radio',
        ],
        'modal' => [
            'class' => Components\Modal::class,
            'alias' => 'wire-modal',
        ],
        'modal.card' => [
            'class' => Components\ModalCard::class,
            'alias' => 'wire-modal.card',
        ],
        'dialog' => [
            'class' => Components\Dialog::class,
            'alias' => 'wire-dialog',
        ],
    ],
];
