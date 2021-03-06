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
     * Returns a paper
     * 
     * @param int $id
     * @return PaperSheet
     */
    public function getPaper($id)
    {
        $papers = $this->config->getPapers();
        return $papers[$id];
    }
    
    /**
     * Creates a layout if possible
     * 
     * @param \Letterpress\PaperSheet $sheet
     * @param \Letterpress\GangRun $gangrun
     * @return null|\Letterpress\Layout
     */
    public function getLayoutFor(PaperSheet $sheet, GangRun $gangrun)
    {
        try {
            return new \Letterpress\Layout($sheet, $gangrun);
        } catch (Exception $exception) {
            return null;
        }
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
        ->add('prints', 'integer', array(
            'max_length' => 4
        ))
        ->add('paper', 'choice', array(
            'choices' => $this->config->getPapers(),
        ))
        ->add('colors', 'choice', array(
            'choices' => array_combine(range(1, 4), range(1, 4))
        ))
        ->add('forms', 'choice', array(
            'choices' => array_combine(range(1, 4), range(1, 4))
        ))
        ->add('shape_length', 'integer',array(
            'max_length' => 4
        ))
        ->add('shape_width', 'integer',array(
            'max_length' => 4
        ))
        ->add('fold_length', 'integer',array(
            'max_length' => 4,
            'required' => false
        ))
        ->add('fold_width', 'integer',array(
            'max_length' => 4,
            'required' => false
        ))
        ->getForm();
        return $form;
    }
    
    /**
     * Creates a new order.
     * 
     * @return \Letterpress\Order
     */
    public function createOrder()
    {
        return new Order($this->config);
    }
}
