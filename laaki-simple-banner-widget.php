<?php 
/**
 * Class Laaki_Simple_Banner_Widget
 */
class Laaki_Simple_Banner_Widget extends WP_widget {

    public $text_domain = '';

    function __construct() {

        $this->text_domain = 'web_design_vista';

        parent::__construct(
  
            // Base ID of your widget
            'Laaki_Simple_Banner_Widget', 
              
            // Widget name will appear in UI
            __('Laaki Simple Banner', $this->text_domain), 
              
            // Widget description
            array( 'description' => __( 'Simple banner widget', $this->text_domain ), ) 
        );
    }

    public function form( $instance ) {

        $bannerExists = false;

        if ( isset( $instance[ 'laaki-simple-banner-title' ] ) ) {
            $title = $instance[ 'laaki-simple-banner-title' ];
        }
        else {
            $title = __( 'Simple Banner Title', $this->text_domain );
        }

        if ( isset( $instance[ 'laaki-simple-banner-uri' ] ) 
        && $instance[ 'laaki-simple-banner-uri' ] != ''
        && $instance[ 'laaki-simple-banner-uri' ] != 'undefined') {
            $banner_uri = $instance[ 'laaki-simple-banner-uri' ];
            $bannerExists = true;
        }
        else {
            $banner_uri = '';
        }

        if ( isset( $instance[ 'laaki-simple-banner-link' ] ) ) {
            $link = $instance[ 'laaki-simple-banner-link' ];
        }
        else {
            $link = '';
        }

        
        // Widget admin form
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'laaki-simple-banner-title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'laaki-simple-banner-title' ); ?>" name="<?php echo $this->get_field_name( 'laaki-simple-banner-title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
       
            <span class="laaki-simple-banner-image" style="width: 100%; display: block">
                <?php if ( $bannerExists ): ?>
                    <img style="width:100%" src="<?php echo $banner_uri;?>" alt="">
                <?php endif; ?>
            </span>
        
        
        <input class="laaki-simple-banner-upload-button button" type="button" value="Upload Image" />
        

        <input 
            type="hidden" 
            id="<?php echo $this->get_field_id( 'laaki-simple-banner-uri' ); ?>" 
            name="<?php echo $this->get_field_name( 'laaki-simple-banner-uri' ); ?>" 
            value="<?php echo esc_attr( $banner_uri ); ?>"
            class="laaki-simple-banner-uri">

        <?php if ( $bannerExists ): ?>        
            <input class="laaki-simple-banner-delete-button button" type="button" value="Delete Image" />
        <?php endif;?>

        <p>
            <label for="<?php echo $this->get_field_id( 'laaki-simple-banner-link' ); ?>"><?php _e( 'Link: [Leave blank for none]' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'laaki-simple-banner-link' ); ?>" name="<?php echo $this->get_field_name( 'laaki-simple-banner-link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
        </p>

        <p>
            <input class="" 
                type="checkbox" 
                <?php if ( isset($instance[ 'laaki-simple-banner-nofollow' ]) ) checked( $instance[ 'laaki-simple-banner-nofollow' ], 'on' ); ?> 
                id="<?php echo $this->get_field_id( 'laaki-simple-banner-nofollow' ); ?>" 
                name="<?php echo $this->get_field_name( 'laaki-simple-banner-nofollow' ); ?>" /> 

            <label for="<?php echo $this->get_field_id( 'laaki-simple-banner-nofollow' ); ?>">No-follow link</label>
        </p>
        <p>
            <input class="" 
                type="checkbox" 
                <?php if ( isset($instance[ 'laaki-simple-banner-open-window' ]) ) checked( $instance[ 'laaki-simple-banner-open-window' ], 'on' ); ?> 
                id="<?php echo $this->get_field_id( 'laaki-simple-banner-open-window' ); ?>" 
                name="<?php echo $this->get_field_name( 'laaki-simple-banner-open-window' ); ?>" /> 

            <label for="<?php echo $this->get_field_id( 'laaki-simple-banner-open-window' ); ?>">Open in a new window</label>
        </p>

        <?php 
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['laaki-simple-banner-title'] = ( ! empty( $new_instance['laaki-simple-banner-title'] ) ) ? strip_tags( $new_instance['laaki-simple-banner-title'] ) : '';
        $instance['laaki-simple-banner-uri'] = ( ! empty( $new_instance['laaki-simple-banner-uri'] ) ) ? strip_tags( $new_instance['laaki-simple-banner-uri'] ) : '';
        $instance['laaki-simple-banner-link'] = ( ! empty( $new_instance['laaki-simple-banner-link'] ) ) ? strip_tags( $new_instance['laaki-simple-banner-link'] ) : '';
        $instance['laaki-simple-banner-nofollow'] = ( ! empty( $new_instance['laaki-simple-banner-nofollow'] ) ) ? strip_tags( $new_instance['laaki-simple-banner-nofollow'] ) : '';
        $instance['laaki-simple-banner-open-window'] = ( ! empty( $new_instance['laaki-simple-banner-open-window'] ) ) ? strip_tags( $new_instance['laaki-simple-banner-open-window'] ) : '';
        return $instance;
    }

    public function widget( $args, $instance ) {

        $title = apply_filters( 'widget_title', $instance['laaki-simple-banner-title'] );
        $banner_uri = isset($instance['laaki-simple-banner-uri'])? $instance['laaki-simple-banner-uri'] : "";
        $banner_link = isset($instance['laaki-simple-banner-link'])? $instance['laaki-simple-banner-link'] : "";
        $nofollow = isset($instance['laaki-simple-banner-nofollow'])? $instance['laaki-simple-banner-nofollow'] : "";
        $open_window = isset($instance['laaki-simple-banner-open-window'])? $instance['laaki-simple-banner-open-window'] : "";
        if ( $nofollow == 'on' ) $nofollowTag = ' rel="nofollow"'; else $nofollowTag = '';
        if ( $open_window == 'on' ) $openWindowTag = ' target="_blank"'; else $openWindowTag = '';
          
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
          
        // This is where you run the code and display the output
        if ( strlen($banner_uri) > 0 ):
            if ( strlen( $banner_link ) > 0 ):
                echo "<a href='" . $banner_link . "' $nofollowTag $openWindowTag>" . "<img src='" . $banner_uri . "'></a>";
            else:
                echo  "<img src='" . $banner_uri . "'>";
            endif;
        else:
            echo __('No Image Found!', $this->text_domain);
        endif;
        
        echo $args['after_widget'];
    }

}