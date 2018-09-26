<?php

namespace FormBuilderBundle\Storage;

use Pimcore\Translation\Translator;

class FormField implements FormFieldInterface
{
    /**
     * @var bool
     */
    protected $update = false;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $order;

    /**
     * @var
     */
    private $constraints = [];

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var
     */
    private $optional = [];

    /**
     * FormField constructor.
     *
     * @param bool $update
     */
    public function __construct($update = false)
    {
        $this->update = $update;
    }

    /**
     * @param Translator $translator
     */
    public function setTranslator(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     *
     * @return FormField
     */
    public function setOrder(int $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return FormField
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return FormField
     */
    public function setDisplayName(string $name)
    {
        $this->displayName = $name;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $type
     *
     * @return FormField
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isUpdated()
    {
        return $this->update;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options = [])
    {
        $this->options = array_filter($options, function ($option) {
            return $option !== '';
        });
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptional(array $options = [])
    {
        if (!is_array($options)) {
            $options = [];
        }

        $this->optional = array_filter($options, function ($option) {
            return $option !== '';
        });
    }

    /**
     * @return array
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * @param array $constraints
     */
    public function setConstraints(array $constraints = [])
    {
        if (!is_array($constraints)) {
            $constraints = [];
        }

        $this->constraints = $constraints;
    }

    /**
     * @return array
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $vars = get_object_vars($this);
        $array = [];
        foreach ($vars as $key => $value) {
            $array[ltrim($key, '_')] = $value;
        }

        $removeKeys = ['translator', 'update'];

        return array_diff_key($array, array_flip($removeKeys));
    }
}
