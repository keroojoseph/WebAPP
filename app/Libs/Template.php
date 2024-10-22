<?php

namespace App\Libs;

class Template
{
    private $_template;
    private $_action_view;
    private $_data;

    public function __construct(array $template)
    {
        $this->_template = $template;
    }

    public function setActionView(string $view)
    {
        $this->_action_view = $view;
    }

    public function setData(array $data)
    {
        $this->_data = $data;
    }

    private function renderTemplateHeaderStart()
    {
        require_once TEMPLATE_PATH . "templateheaderstart.php";
    }

    private function renderTemplateHeaderEnd()
    {
        require_once TEMPLATE_PATH . "templateheaderend.php";
    }

    private function renderTemplateFooter()
    {
        require_once TEMPLATE_PATH . "templatefooter.php";
    }
    private function renderTemplateBlocks()
    {
        if (!array_key_exists('template', $this->_template)) {
            trigger_error('Sorry, you have to define template blocks', E_USER_WARNING);
        } else {
            $parts = $this->_template['template'];

            if (!empty($parts)) {
                extract($this->_data);
                foreach ($parts as $partKey => $file) {
                    if ($partKey === 'view') {
                        require_once $this->_action_view;
                    } else {
                        require_once $file;
                    }
                }
            }
        }
    }

    private function renderHeaderResources()
    {
        $output = '';

        if (!array_key_exists('header_resources', $this->_template)) {
            trigger_error('Sorry, you have to define header resources', E_USER_WARNING);
        } else {
            $resources = $this->_template['header_resources'];

            // Generate CSS links
            $css = $resources['css'];

            if (!empty($css)) {
                foreach ($css as $cssKey => $cssFile) {
                    $output .= '<link rel="stylesheet" href="' . $cssFile . '">';
                }
            }

            // Generate JS script
            $js = $resources['js'];

            if (!empty($js)) {
                foreach ($js as $jsKey => $jsFile) {
                    $output .= '<script src="' . $jsFile . '"></script>';
                }
            }

        }
        echo $output;
    }

    private function renderFooterResources()
    {
        $output = '';

        if (!array_key_exists('footer_resources', $this->_template)) {
            trigger_error('Sorry, you have to define footer resources', E_USER_WARNING);
        } else {
            $resources = $this->_template['footer_resources'];

            if (!empty($resources)) {
                foreach ($resources as $resourcesKey => $resourcesFile) {
                    $output .= '<script src="' . $resourcesFile . '"></script>';
                }
            }

        }
        echo $output;
    }

    public function renderApp()
    {
        $this->renderTemplateHeaderStart();
        $this->renderHeaderResources();
        $this->renderTemplateHeaderEnd();
        $this->renderTemplateBlocks();
        $this->renderFooterResources();
        $this->renderTemplateFooter();
    }
}