<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\AppCodeBlock;

/**
 * @description A single app code block form element.
 * Multiple elements build up the view creating a form. An element can be static content of an input
 * field. These elements are styled by CCV Shop to give the impression of a seamless integration into
 * the CCV Shop environment. The properties within an element are:
 * • Name: unique identifier of this element. Will be used as key when posting data.
 * • Label: for input fields this will be a label for this element.
 * • element_type: The type of element, e.g. an "text" input.
 * • Value: the initial value of this element.
 * • deeplink: Only used for deeplinks and attachments. Should contain the remote link to the file.
 * • icon: Elements with the type ‘input_button’ and ‘deeplink’ may use the property ‘icon’. We support all icons from the icon set ‘font-awesome’4.
 * • action: An action can be assigned to an `input_button`.
 * • Options: Additional options for this element. Used for selects and radio elements.
 */
class Element extends AppCodeBlock
{
    public ?string $name = null;
    /**
     * @description could either be an string or a object.
     * @var mixed $label
     */
    public         $label;
    public ?string $element_type = null;
    /**
     * @description could either be an string or a object.
     * @var mixed $value
     */
    public                   $value;
    public ?string           $deeplink = null;
    public ?string           $icon     = null;
    public ?string           $action   = null;
    public ?OptionCollection $options  = null;

    public static array $entities = ['options' => OptionCollection::class];
}
