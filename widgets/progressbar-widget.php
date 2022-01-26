<?php

class Elementor_Progressbar_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'progressbarWidget';
    }

    public function get_title()
    {
        return __('Progressbar Widget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'fa fa-spinner';
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

        $this->add_control('bar-color', [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => esc_html__('Content', 'elementor-addon'),
            'default' => '#222222'
        ]);

        $this->add_control('bar-fill', [
            'type' => \Elementor\Controls_Manager::TEXT,
            'label' => esc_html__('Fill Amount', 'elementor-addon'),
            'default' => '0.8'
        ]);

        $this->add_control('bar-height', [
            'type' => \Elementor\Controls_Manager::TEXT,
            'label' => esc_html__('Bar Height', 'elementor-addon'),
            'default' => '10px'
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $color = $this->get_settings('bar-color');
        $fill = $this->get_settings('bar-fill');
        $height = $this->get_settings('bar-height');
?>
        <div class="progress" data-bar_color="<?php echo $color; ?>" data-bar_fill="<?php echo $fill; ?>" data-bar_height="<?php echo $height; ?>"></div>
<?php
    }

    protected function _content_template()
    {
    }
}
