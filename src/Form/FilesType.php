<?php

namespace App\Form;

use App\Entity\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilesType extends AbstractType
{

    protected $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $manager = $this->manager;
        $collection = new ArrayCollection();

        //convert view data into concrete file objects
        //save it to collection var because the normalization
        //will overwrite the model data immediately

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($manager, &$collection, $options) {
                $data = $event->getData();
                if ($data) {
                    if ($options['multiple']) {
                        foreach ($data as $formFile) {
                            $file = $manager->getRepository(File::class)->find($formFile['id']);
                            $file->setFilename($formFile['filename']);
                            $file->setSlug($formFile['slug']);
                            $file->setOrder($formFile['order']);
                            if(isset($formFile['parameters'])) {
                                $file->setParameters($formFile['parameters']);
                            }
                            $file->setGarbage(false);
                            $collection->add($file);
                        }
                    } else {
                        $file = $manager->getRepository(File::class)->find($data['id']);
                        $file->setFilename($data['filename']);
                        $file->setSlug($data['slug']);
                        $file->setOrder($data['order']);
                        if(isset($data['parameters'])) {
                            $file->setParameters($data['parameters']);
                        }
                        $file->setGarbage(false);
                        $collection->add($file);
                    }
                }

                //set data to null to keep form synchronized
                $event->setData(null);
            }
        );

        $builder->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event) use ($collection, $options) {
                if ($options['multiple']) {
                    $event->setData($collection);
                } else {
                    $event->setData($collection->get(0));
                }
            }
        );

    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if(array_key_exists('information', $options) && is_array($options['information'])) {
            $view->information = $options['information'];
        } else {
            $view->information = array();
        }
        $view->vars['multiple'] = $options['multiple'];
        $fields = $options['fields'];
        foreach ($fields as $index => $field) {
            if (!isset($field['translationDomain'])) {
                $fields[$index]['translationDomain'] = '';
            }
            if (!isset($field['type'])) {
                $fields[$index]['type'] = 'text';
            }
            if ($fields[$index]['type'] == 'choices') {
                if (!isset($field['choices'])) {
                    $fields[$index]['choices'] = array();
                }
            }
        }
        $view->vars['fields'] = $fields;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'multiple'      => true,
            'fields'        => array(
                'title'         => array(
                    'label'             => 'Title label',
                ),
                'alt_tag'       => array(
                    'label'             => 'Alt tag label',
                )
            )
        ));

        $resolver->setDefined(array(
            'information'
        ));

    }

    public function getParent()
    {
        return 'form';
    }
}
