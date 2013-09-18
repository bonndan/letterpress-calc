<?php

namespace Letterpress;

class Application
{
    /**
     * app instance
     * @var \Silex\Application
     */
    private $app;
    
    /**
     * letterpress configuration
     * 
     * @var Config
     */
    private $config;
    
    /**
     * Constructor.
     * 
     * @param \Silex\Application $app
     */
    public function __construct(\Silex\Application $app, Config $config)
    {
        $this->app = $app;
        $this->config = $config;
    }
    
    /**
     * Creates the form.
     * 
     * @param array $data
     * @return \Symfony\Component\Form\Form
     */
    public function getForm()
    {
        $form = $this->app['form.factory']->createBuilder('form', array())
        ->add('name')
        ->add('email')
        ->add('gender', 'choice', array(
            'choices' => array(1 => 'male', 2 => 'female'),
            'expanded' => true,
        ))
        ->getForm();
        return $form;
    }
}
