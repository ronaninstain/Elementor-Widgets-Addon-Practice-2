<?php

class Elementor_Infobox_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'infoboxWidget';
    }

    public function get_title()
    {
        return __('Infobox Widget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'fa fa-info';
    }

    public function get_category()
    {
        return ['general'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('box-color', [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => esc_html__('Box Color', 'elementor-addon'),
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .info' => 'background: {{Value}}'
            ]
        ]);

        $this->add_control('box-svg', [
            'type' => \Elementor\Controls_Manager::TEXT,
            'label' => esc_html__('Box SVG', 'elementor-addon'),
        ]);

        $this->add_control('box-title', [
            'type' => \Elementor\Controls_Manager::TEXT,
            'label' => esc_html__('Box Title', 'elementor-addon'),
            'default' => 'TITLE'
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $title = $this->get_settings('box-title');
?>
        <div class="info"><?php echo esc_html($title);?></div>

        <div class="success"><?php echo esc_html($title);?></div>

        <div class="warning"><?php echo esc_html($title);?></div>

        <div class="error"><?php echo esc_html($title);?></div>
<?php
    }

    protected function _content_template()
    {
    }
}
