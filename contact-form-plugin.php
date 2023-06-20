<?php
/**
 * Plugin Name: Contact Form Plugin
 * Description: Plugin to add a contact form shortcode.
 * Version: 1.0.0
 * Author: Ramsha Tariq
 */

// Register the shortcode [contact_form]

// Enqueue plugin stylesheet
add_action( 'admin_enqueue_scripts', 'backendCs' );
function backendCs($hook ) {
     if(get_post_type()=="contactform")
        {
            wp_enqueue_style( 'admin_css', plugins_url( 'assets/css/style.css', __FILE__ ));

        }

   }
add_shortcode('contact_form', 'contact_form_shortcode');
// Shortcode callback function
function contact_form_shortcode($atts) {

  return require_once('inc/shortcode_frontend.php');
}
require_once('inc/custom_post_type.php');
// Add metabox to a specific post type (e.g., 'post')
add_action('add_meta_boxes', 'add_custom_metabox');

function add_custom_metabox() {
    add_meta_box(
        'custom_metabox',
        'Contact Information',
        'render_custom_metabox',
        'contactform',
        'normal',
        'default'
    );
}
function render_custom_metabox($post) {
    // Retrieve existing values for the fields (if any)
    $custom_metabox_nonce = wp_create_nonce( 'custom_metabox_nonce' );
    $contact_configuration = unserialize(get_post_meta($post->ID, 'contact_configuration', true));

    // Output the HTML content of the metabox
    ?>
    <p class="fs-16px">Please ensure that the mandatory fields are checked.</p>
    <input type="hidden" name="custom_metabox_nonce" value="<?php echo $custom_metabox_nonce; ?>">
   <p class="form-p">
  <input type="checkbox" id="first_name" onclick="nextQuestion.call(this,'First Name')" name="first_name" <?php echo (isset(($contact_configuration['first_name'])))?" checked":""; ?>>
  <br>
  <label for="first_name">First Name:</label>
</p>



<?php if (isset(($contact_configuration['first_name']))) { ?>
  <p class="form-p" id="first_name_mp">
    <input type="checkbox" id="first_name_m" name="first_name_m" <?php echo isset(($contact_configuration['first_name_m'])) ? "checked":""; ?>>
    <br>
    <label for="first_name_m">Should First Name be mandatory?</label>
  </p>
<?php } ?>

<p class="form-p">
  <input type="checkbox" id="last_name" onclick="nextQuestion.call(this,'Last Name')" name="last_name" <?php echo (isset(($contact_configuration['last_name'])))?" checked":""; ?>>
  <br>
  <label for="last_name">Last Name:</label>
</p>

<?php if (isset(($contact_configuration['last_name']))) { ?>
  <p class="form-p" id="last_name_mp">
    <input type="checkbox" id="last_name_m" name="last_name_m" <?php echo isset(($contact_configuration['last_name_m'])) ? "checked":""; ?>>
    <br>
    <label for="last_name_m">Should Last Name be mandatory?</label>
  </p>
<?php } ?>

<p class="form-p">
  <input type="checkbox" id="job_title" onclick="nextQuestion.call(this,'Job Title')" name="job_title" <?php echo (isset(($contact_configuration['job_title'])))?" checked":""; ?>>
  <br>
  <label for="job_title">Job Title:</label>
</p>

<?php if (isset(($contact_configuration['job_title']))) { ?>
  <p class="form-p" id="job_title_mp">
    <input type="checkbox" id="job_title_m" name="job_title_m" <?php echo isset(($contact_configuration['job_title_m'])) ? "checked":""; ?>>
    <br>
    <label for="job_title_m">Should Job Title be mandatory?</label>
  </p>
<?php } ?>

<p class="form-p">
  <input type="checkbox" id="company" onclick="nextQuestion.call(this,'Company')" name="company" <?php echo (isset(($contact_configuration['company'])))?" checked":""; ?>> 
  <br>
  <label for="company">Company:</label>
</p>

<?php if (isset(($contact_configuration['company']))) { ?>
  <p class="form-p" id="company_mp">
    <input type="checkbox" id="company_m" name="company_m" <?php echo isset(($contact_configuration['company_m'])) ? "checked":""; ?>>
    <br>
    <label for="company_m">Should Company be mandatory?</label>
  </p>
<?php } ?>

<p class="form-p">
  <input type="checkbox" id="website_link" onclick="nextQuestion.call(this,'Website URL')" name="website_link" <?php echo (isset(($contact_configuration['website_link'])))?" checked":""; ?>> 
  <br>
  <label for="website_link">Website URL:</label>
</p>

<?php if (isset(($contact_configuration['website_link']))) { ?>
  <p class="form-p" id="website_link_mp">
    <input type="checkbox" id="website_link_m" name="website_link_m" <?php echo isset(($contact_configuration['website_link_m'])) ? "checked":""; ?>>
    <br>
    <label for="website_link_m">Should Website URL be mandatory?</label>
  </p>
<?php } ?>

<p class="form-p">
  <input type="checkbox" id="message" onclick="nextQuestion.call(this,'Message/Question')" name="message" <?php echo (isset(($contact_configuration['message'])))?" checked":""; ?>> 
  <br>
  <label for="message">Message/Question:</label>
</p>

<?php if (isset(($contact_configuration['message']))) { ?>
  <p class="form-p" id="message_mp">
    <input type="checkbox" id="message_m" name="message_m" <?php echo isset(($contact_configuration['message_m'])) ? "checked":""; ?>>
    <br>
    <label for="message_m">Should Message/Question be mandatory?</label>
  </p>
<?php } $radioBtn="";$radioBtn2="";$radioBtn3="";
if(isset($contact_configuration['display'])){

if($contact_configuration['display']=='popup'){
    $radioBtn2='checked';
}
else{
    if($contact_configuration['display']=='slider'){
            $radioBtn3='checked';

    }
    else{
        if($contact_configuration['display']=='page'){
                        $radioBtn='checked';

        }
    }

} }else $radioBtn="checked";?>

   
    <p class="form-p">
<label for="website_url">Ajax URL:</label><br>
<input type="text" id="website_url"  name="website_url" value="<?php echo (isset(($contact_configuration['website_url'])))?esc_attr($contact_configuration['website_url']):""; ?>">
    </p>

    <div class="pb-2em">  
      <p class="fs-16px">Please select how would you want your form to be displayed.</p>
<label>
  <input  type="radio" name="display" value="page" <?php echo $radioBtn; ?>>
  Display in page
</label>

<label>
  <input  type="radio" name="display" value="popup" <?php echo $radioBtn2; ?>>
  Display in popup
</label>

<label>
  <input  type="radio" name="display" value="slider"  <?php echo$radioBtn3; ?>>
  Display in slider
</label>

    </div>
    <div class="bg-d3d3d3" style="padding:15px;">
         <span style="font-size: 16px;" class=" border-none result-shortcode fs-15px pt-5px">[contact_form id='<?php echo get_the_ID(); ?>']</span>
    </div>
    <script type="text/javascript">
     function   nextQuestion(name){
var element = document.getElementById(this.name+'_mp');
if (element) {
  element.remove();
} 
        if(this.checked){
             let nameElement = this.name;

    // Create the HTML code for the new paragraph
    var paragraphHTML = `
      <p id="${nameElement}_mp" class="form-p">
        <input type="checkbox" id="${nameElement}_m" name="${nameElement}_m">
        <br>
        <label for="${nameElement}_m">Should ${name} be mandatory?</label>
      </p>
    `;

this.parentElement.insertAdjacentHTML('afterend', paragraphHTML);}
     }
  


</script>
    <?php
}
// Save metabox data
add_action('save_post', 'save_custom_metabox');

function save_custom_metabox($post_id) {
    // Verify the nonce to ensure the data is coming from the correct form
 if (!isset($_POST['custom_metabox_nonce']) || !wp_verify_nonce($_POST['custom_metabox_nonce'], 'custom_metabox_nonce')) { 
       return;
   }
   $mandatory=[];
    if (isset($_POST['first_name'])) {
        $mandatory['first_name']=            sanitize_text_field($_POST['first_name']);
        if (isset($_POST['first_name_m'])) {
        $mandatory['first_name_m']=            sanitize_text_field($_POST['first_name_m']);
        }
    }
    if (isset($_POST['last_name'])) {
        $mandatory['last_name']=            sanitize_text_field($_POST['last_name']);
        if (isset($_POST['last_name_m'])) {
        $mandatory['last_name_m']=            sanitize_text_field($_POST['last_name_m']);
        }
    }
    if (isset($_POST['job_title'])) {
        $mandatory['job_title']=            sanitize_text_field($_POST['job_title']);
        if (isset($_POST['job_title_m'])) {
        $mandatory['job_title_m']=            sanitize_text_field($_POST['job_title_m']);
        }
    }
    if (isset($_POST['company'])) {
        $mandatory['company']=            sanitize_text_field($_POST['company']);
        if (isset($_POST['company_m'])) {
        $mandatory['company_m']=            sanitize_text_field($_POST['company_m']);
        }
    }
        if (isset($_POST['website_link'])) {
        $mandatory['website_link']=            sanitize_text_field($_POST['website_link']);
        if (isset($_POST['website_link_m'])) {
        $mandatory['website_link_m']=            sanitize_text_field($_POST['website_link_m']);
        }
    }
    if (isset($_POST['message'])) {
        $mandatory['message']=            sanitize_text_field($_POST['message']);
        if (isset($_POST['message_m'])) {
        $mandatory['message_m']=            sanitize_text_field($_POST['message_m']);
        }
    }
    if (isset($_POST['website_url'])) {
        $mandatory['website_url']=            sanitize_text_field($_POST['website_url']);
    }
    if (isset($_POST['display'])) {
        $mandatory['display']=            sanitize_text_field($_POST['display']);
    }
    //echo'<pre>';print_r($mandatory);die;
   $mandatory =serialize($mandatory);
    // Save each field value
 update_post_meta($post_id,'contact_configuration',$mandatory);

}

// r
add_action('init', 'check_create_contact_us_table');

function check_create_contact_us_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'contact_us';

    // Check if the table exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        create_contact_us_table();
    }
}

// Function to create the 'contact_us' table
function create_contact_us_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'contact_us';
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
                id INT(11) NOT NULL AUTO_INCREMENT,
                first_name VARCHAR(255) NULL,
                last_name VARCHAR(255) NULL,
                job_title VARCHAR(255) NULL,
                company VARCHAR(255) NULL,
                website_link VARCHAR(255) NULL,
                message VARCHAR(255) NULL,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci";   
             require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
// r
//require_once('inc/contact-us-API.php');
}
//contact-form-plugin.php
add_action('rest_api_init', 'my_api_endpoint');
function my_api_endpoint() {
    register_rest_route('contact-form-plugin/v1', 'store', array(
        'methods'  => 'POST',
        'callback' => 'store_data',
        'permission_callback' => 'custom_rest_route_permission_callback',

    ));
}
function custom_rest_route_callback( $request ) {
    $has_permission = true; // Replace with your permission logic
    
    return current_user_can('edit_posts');
}
function store_data(WP_REST_Request $request) {
    // Retrieve the data from the API request
    $data = $request->get_json_params();
    // Store the data in the database
   
    global $wpdb;

    // Get the data from the API request
   $info=['first_name'=>'','last_name'=>'','job_title'=>'','company'=>'','website_link'=>'','message'=>''];
    if (isset($data['first_name'])) {
        $info['first_name']=            sanitize_text_field($data['first_name']);

    }
    if (isset($data['last_name'])) {
        $info['last_name']=            sanitize_text_field($data['last_name']);
   
    }
    if (isset($data['job_title'])) {
        $info['job_title']=            sanitize_text_field($data['job_title']);
    
    }
    if (isset($data['company'])) {
        $info['company']=            sanitize_text_field($data['company']);
       
    }
        if (isset($data['website_link'])) {
        $info['website_link']=            sanitize_text_field($data['website_link']);
    
    }
    if (isset($data['message'])) {
        $info['message']=            sanitize_text_field($data['message']);
 
    }
    // Insert the data into the 'contact_us' table
    $table_name = $wpdb->prefix . 'contact_us';
    $wpdb->insert($table_name, $info);

      // Return a response
    $response = array(
        'message' => $data,
    );

    return new WP_REST_Response($response, 200 ,array('Content-Type' => 'application/json'));
}

register_uninstall_hook( __FILE__, 'plugin_cleanup' );

    function plugin_cleanup(){
$post_ids = get_posts( array( 
    'post_type' => 'contactform',
    'numberposts' => -1,   
    'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'), ) );

foreach ( $post_ids as $post_id ) {

    delete_post_meta_by_key( 'contact_configuration', $post_id->ID );
    wp_delete_post($post_id->ID, true);

}

global $wpdb;

$table_name = $wpdb->prefix . 'contact_us';

$wpdb->query("DROP TABLE IF EXISTS $table_name");
}
