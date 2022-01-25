<?php

class Elementor_Pricing_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'PricingWidget';
    }

    public function get_title()
    {
        return esc_html__('PricingWidget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'fa fa-table';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['pricing', 'table'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('style', [
            'label' => __('Style', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'option' => [
                'default' => __('Default', 'elementor-addon'),
                'blue' => __('Blue Style', 'elementor-addon'),
            ],
        ]);

        $this->add_control('style_select_hidden', [
            'label' => __('Style', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::HIDDEN,
            'default' => 'style_select_hidden'
        ]);

        $this->add_control('title', [
            'label' => __('Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $this->add_control('dummy', [
            'type' => \Elementor\Controls_Manager::HIDDEN,
            'default' => 'dummy'
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('featured', [
            'label' => __('Featured', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false
        ]);

        $repeater->add_control('title', [
            'label' => __('Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $repeater->add_control('description', [
            'label' => __('Description', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
        ]);

        $repeater->add_control('items', [
            'label' => __('Items', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
        ]);

        $repeater->add_control('items_hidden_selector', [
            'label' => __('Style', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::HIDDEN,
            'default' => 'items_hidden_selector'
        ]);

        $repeater->add_control('pricing', [
            'label' => __('Pricing', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $repeater->add_control('button_title', [
            'label' => __('Button Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('BUY NOW', 'elementor-addon')
        ]);

        $repeater->add_control('button_url', [
            'label' => __('Button URL', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::URL,
        ]);

        $this->add_control('pricings', [
            'label' => __('Pricing Columns', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $heading = $this->get_settings('title');
        $pricings = $this->get_settings('pricing');
        $style = $this->get_settings('style');

        if ('default' == $style) {
?>
            <section class="fdb-block" style="background-image: url(<?php echo plugins_url("../assets/images/red.svg", __FILE__); ?>);">
                <div class="container">
                    <div class="row text-center">
                        <div class="col">
                            <h1 class="text-white"><?php echo esc_html($heading) ?></h1>
                        </div>
                    </div>

                    <div class="row mt-5 align-items-center">
                        <?php
                        if ($pricings) {
                            foreach ($pricings as $pricing) {

                                $button_class = $pricing['feautred'] ? 'secondary' : 'dark';
                        ?>
                                <div class="col-12 col-sm-10 col-md-8 m-auto col-lg-4 text-center">
                                    <div class="fdb-box p-4">
                                        <h2><?php echo esc_html($pricing['title']) ?></h2>
                                        <p class="lead"><?php echo esc_html($pricing['description']) ?></p>

                                        <p class="h1 mt-5 mb-5"><?php echo apply_filters('pricing_prefix', '$'); ?><?php echo esc_html($pricing['pricing']) ?></p>

                                        <p><a href="<?php echo esc_url($pricing['button_url']['url']) ?>" class="btn btn-<?php echo esc_attr__($button_class); ?>"><?php echo esc_html($pricing['button_title']) ?></a></p>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?php
        } else {
        ?>
            <section class="fdb-block" style="background-image: url(./imgs/shapes/1.svg)">
                <div class="container">
                    <div class="row text-center">
                        <div class="col">
                            <h1 class="text-light"><?php echo esc_html($heading) ?></h1>
                        </div>
                    </div>

                    <div class="row mt-5 align-items-center">
                        <?php
                        if ($pricings) {
                            foreach ($pricings as $pricing) {

                                $button_class = $pricing['feautred'] ? 'secondary' : 'dark';
                        ?>
                                <div class="col-12 col-sm-10 col-md-8 col-md-8 m-auto col-lg-4 text-center">
                                    <div class="fdb-box shadow pb-5 pt-5 pl-3 pr-3 rounded">
                                        <h2><?php echo esc_html($pricing['title']) ?></h2>
                                        <p class="lead"><?php echo apply_filters('pricing_prefix', '$'); ?><?php echo esc_html($pricing['pricing']) ?></strong></p>
                                        <p class="h3 font-weight-light"><?php echo esc_html($pricing['description']) ?></p>

                                        <ul class="text-left mt-5 mb-5">
                                            <?php
                                            $items = explode("\n", trim($pricing['items']));
                                            foreach ($items as $item) {
                                                if ($item) {
                                                    echo "<li> {$item} </li>";
                                                }
                                            }
                                            ?>
                                        </ul>

                                        <p><a href="https://www.froala.com" class="btn btn-outline-<?php echo esc_attr__($button_class); ?>">Subscribe</a></p>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
<?php
        }
    }

    protected function _content_template()
    {
    }
}
