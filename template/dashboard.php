<?php

use Inc\Base\BaseController;
$control = new BaseController();

use Inc\Data\DisplayData;
$display_data = new DisplayData();

use Inc\Data\InsertProducts;
$insert_product = new InsertProducts();

use Inc\Data\InsertStock;
$insert_stock = new InsertStock();

/*$option = get_option('hmu_api_basic');
//$url = $option['basic_auth_url'].'Products/ALL'.$this->url;
$url = 'https://online.crossovertec.co.uk/StockLevels/ALL?DateAdjusted=2018-06-22T00:00:00&MaxResults=1000';
$user = $option["basic_auth_username"];
$pass = $option["basic_auth_password"];




//   echo $show = 'website: '.$url.' ck: '.$user.' cs: '.$pass;
$data = array($url, $user, $pass);


$wp_request_headers = array(
    'Authorization' => 'Basic ' . base64_encode( $user.':'.$pass )
);

$wp_request_url = $url;

$wp_get_post_response = wp_remote_request(
    $wp_request_url,
    array(
        'method'    => 'GET',
        'headers'   => $wp_request_headers
    )
);

if(!is_wp_error($wp_get_post_response) && ($wp_get_post_response['response']['code'] == 200 || $wp_get_post_response['response']['code'] == 201)) {

    // echo wp_remote_retrieve_response_code( $wp_get_post_response ) . ' ' . wp_remote_retrieve_response_message( $wp_get_post_response );
    $res = json_decode($wp_get_post_response['body']);




    foreach ($res as $r) {

        $stdInstance = json_decode(json_encode($r), true);
        echo '<pre>';
      //  var_dump($stdInstance );
        echo '</pre>';
        echo $crossover_ID = $stdInstance["ProductID"] .'<br/>';
        echo $crossover_level = $stdInstance["StockLevel"];




    }


}*/


?>


    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>


    <div class="wrap">
		<?php settings_errors(); ?>
		<?php
		$active_tab = '';
		if( isset( $_GET[ 'tab' ] ) )
			$active_tab = $_GET[ 'tab' ];
		?>

		<?php


		if( isset( $_GET[ 'delete' ] ) && $_GET[ 'delete' ] =='ba'  ) {


			delete_option('hmu_api_basic');
			$url = admin_url() . '?page=hmu_api_plugin&tab=basic_auth';
			header('Location: ' . $url);
			die();
		}

		?>




        <h2 class="nav-tab-wrapper">
            <a href="?page=hmu_api_plugin&tab=basic_auth" class="nav-tab <?php echo ( $_GET[ 'tab' ] ==''  ||  $_GET[ 'tab' ] =='basic_auth'  ) ? 'tab-active' :  '';
			?> <?php
			echo ( $_GET[ 'tab' ] ==''  ) ?
				$_GET[ 'tab' ] :  ''; ?>">Basic
                Auth</a>
            <a href="?page=hmu_api_plugin&tab=all_products" class="nav-tab <?php echo  ( $_GET[ 'tab' ] =='all_products' ) ? 'tab-active' :  ''; ?>">All Porducts</a>
            <a href="?page=hmu_api_plugin&tab=orders" class="nav-tab <?php echo  ( $_GET[ 'tab' ] =='orders' ) ? 'tab-active' :  ''; ?>">Orders</a>
            <a href="?page=hmu_api_plugin&tab=cron" class="nav-tab <?php echo  ( $_GET[ 'tab' ] =='cron' ) ? 'tab-active' :  ''; ?>">Cron</a>
        </h2>
        <!-- ===========================================================================================================

                       MAIN TAG - init the plugin main functions

     =============================================================================================================-->


        <div class="container">

			<?php
			if( $active_tab == 'basic_auth' || $active_tab == ''  ):

				?>


                <form method="post" class="hmu-general-form" action="options.php">
					<?php
					settings_fields( 'hmu_api_dashboard_options_group' );
					do_settings_sections( 'hmu_api_plugin' );
					submit_button( 'Save Settings', 'hmu-btn hmu-primary', 'btnSubmit' );
					?>

                </form>
                <!-- ==== received data  ===== -->

				<?php

				$option = get_option('hmu_api_basic');
				$url = $option['basic_auth_url'];
				$username = $option["basic_auth_username"];
				$password = $option["basic_auth_password"];

				?>

                <h3>Basic Control</h3>
				<?php



				?>

                <hr>
                <h4>Update stock</h4>
                <form action="" method="post" class="">
                    <input class="hmu-input hmu-success" type="submit" name="update_stock" value="Update Stock">
                    <select name="year">
                        <option value="">Year</option>
		                <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
		                <?php } ?>
                    </select>
                    <select name="month">
                        <option value="">Month</option>
		                <?php for ($month = 1; $month <= 12; $month++) { ?>
                            <option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
		                <?php } ?>
                    </select>
                    <select name="day">
                        <option value="">Day</option>
		                <?php for ($day = 1; $day <= 31; $day++) { ?>
                            <option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
		                <?php } ?>
                    </select>
                </form>
                <hr>
                <h4>Update product</h4>
                <form action="" method="post" class="">
                    <input class="hmu-input hmu-success" type="submit" name="insert_products" value="Insert All Products">
                    <select name="year">
                        <option value="">Year</option>
						<?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
						<?php } ?>
                    </select>
                    <select name="month">
                        <option value="">Month</option>
						<?php for ($month = 1; $month <= 12; $month++) { ?>
                            <option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
						<?php } ?>
                    </select>
                    <select name="day">
                        <option value="">Day</option>
						<?php for ($day = 1; $day <= 31; $day++) { ?>
                            <option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
						<?php } ?>
                    </select>
                </form>
                <div class="clear"></div>

				<?php
				if(isset($_POST['update_stock'])) {

					$year = $_POST['year'];
					$month =  $_POST['month'];
					$day =  $_POST['day'];
					$date = $year.'-'.$month.'-'.$day;

					($year !='' && $month !='' ) ? $date : $date = date("Y-m-d");

					/*$option = get_option('hmu_api_basic');
					$urls = $option['basic_auth_url'].'Products/ALL?DateAdjusted='.$date.'T00:00:00&WebOnly=1';*/



                    $output_1 = $insert_stock->hmu_get_stock( $date, true );
                    echo $output_1;





				}

				?>

				<?php


				if(isset($_POST['insert_all_products']) || isset($_POST['insert_products']) ) {

					$year = $_POST['year'];
					$month =  $_POST['month'];
					$day =  $_POST['day'];
					$date = $year.'-'.$month.'-'.$day;

					($year !='' && $month !='' ) ? $date : $date = date("Y-m-d");

					echo '<h1>Result: </h1>';

					$option = get_option('hmu_api_basic');
					$url = $option['basic_auth_url'].'Products/ALL?DateAdjusted='.$date.'T00:00:00&WebOnly=1';

					$data_array  = $display_data->hmu_main_loop($url);

					$results     = $insert_product->insert_all($data_array);

					$output ="<table class=\"widefat fixed\" cellspacing=\"0\">\n\n";
					$output .= "<thead>\n\n";
					$output .= "<tr>\n\n";
					$output .= "<th > Product title </th>";
					$output .= "<th > Status</th>";
					$output .= "<th> Variation title</th>";
					$output .= "<th> Variation status</th> ";
					$output .= "<th> Variation Stock level</th> ";


					$output .= "</tr>\n\n";
					$output .= "</thead>\n\n";
					$output .= "<tbody> \n";

					foreach ($results as $result) {
						$output .= "<tr>\n";

						$output .= "<td>" . $result['post_name'] . "</td>";
						$output .= "<td>" . $result['status'] . "</td>";
						$output .= "<td>" . @$result['variation_post']  . "</td>";
						$output .= "<td>" . @$result['variation_status']   . "</td>";
						$output .= "<td>" . @$result['variation_stock'] . "</td>";


						$output .= "</tr>\n";
					}


					$output .= "</tbody> \n ";
					$output .= "\n</table>";

					echo $output;
				}



				?>


                <h3>Website:</h3>

                <table class="widefat fixed" cellspacing="0">

                    <thead>

                    <tr>

                        <th> Website Url</th>
                        <th> Username</th>
                        <th> Password</th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $url; ?></td>
                        <td><?php echo $username; ?></td>
                        <td><input id="hmuInput" type="password" value="<?php echo $password; ?>" disabled><i class="fas fa-eye"></i></td>
                    </tr>
                    </tbody>

                </table>

                <hr>
                <br/>
                <a class=" hmu-input hmu-delete" href="<?php echo admin_url() ?>?page=hmu_api_plugin&tab=basic_auth&delete=ba">Delete table</a>
			<?php elseif($active_tab == 'auth_one'): ?>
         <!--       <form method="post" class="hmu-general-form" action="options.php">
					<?php
/*					settings_fields( 'hmu_api_dashboard_second_group' );
					do_settings_sections( 'hmu_api_auth_plugin' );
					submit_button( 'Save Settings', 'hmu-btn hmu-primary', 'btnSubmit' );


					*/?>

                </form>


                <!-- ==== received data ===== -->

				<?php
/*
				$option = get_option('hmu_api_oauth_one');
				$url = $option['auth_one_url'];
				$ck = $option["auth_one_ck"];
				$cs = $option["auth_one_cs"];
				*/?>
                <h2>oAuth 1</h2>
                <table class="widefat fixed" cellspacing="0">

                    <thead>

                    <tr>

                        <th> Website Url</th>
                        <th> CK</th>
                        <th> CS</th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <td><?php /*echo $url; */?></td>
                        <td><?php /*echo $ck; */?></td>
                        <td><?php /*echo $cs; */?></td>
                    </tr>
                    </tbody>

                    <tbody>
                    </tbody>

                </table>
            <!-- ===========================================================================================================

                   Product tag - display products

           =============================================================================================================-->

			<?php elseif ($active_tab == 'all_products'): ?>
                <h1>All Porducts</h1>
                <p>Link: Products/ALL?DateAdjusted=2018-02-20T00:00:00 </p>

                <form action="" method="post">
                    <input class="hmu-btn hmu-primary" type="submit" name="display_all_products" value="Display Products">
                    <select name="year">
                        <option value="">Year</option>
						<?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
						<?php } ?>
                    </select>
                    <select name="month">
                        <option value="">Month</option>
						<?php for ($month = 1; $month <= 12; $month++) { ?>
                            <option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
						<?php } ?>
                    </select>
                    <select name="day">
                        <option value="">Day</option>
						<?php for ($day = 1; $day <= 31; $day++) { ?>
                            <option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
						<?php } ?>
                    </select>

                </form>

				<?php
				if( isset( $_POST['display_all_products'] ) ) {

					$year = $_POST['year'];
					$month =  $_POST['month'];
					$day =  $_POST['day'];
					$date = $year.'-'.$month.'-'.$day;

					($year !='' && $month !='' ) ? $date : $date = date("Y-m-d");

					echo '<h1>Result for: '.$date.' </h1>';

					$option = get_option('hmu_api_basic');
					$url = $option['basic_auth_url'].'Products/ALL?DateAdjusted='.$date.'T00:00:00&WebOnly=1';


					ob_start();
					$display_data->hookeMeUp_display_basic_result( $url );
					$output = ob_get_contents();  // stores buffer contents to the variable
					ob_end_clean();
					echo $output;
				}

				?>
            <!-- ===========================================================================================================

                   STOCK TAG - display stock level

           =============================================================================================================-->


			<?php elseif ($active_tab == 'orders'): ?>
                <h1>Stock level</h1>
                <p>Show stock by date adjust </p>

                <form action="" method="post">
                    <input class="hmu-btn hmu-primary" type="submit" name="display_all_stock" value="Display stock level">
                    <select name="year">
                        <option value="">Year</option>
                        <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                        <?php } ?>
                    </select>
                    <select name="month">
                        <option value="">Month</option>
                        <?php for ($month = 1; $month <= 12; $month++) { ?>
                            <option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
                        <?php } ?>
                    </select>
                    <select name="day">
                        <option value="">Day</option>
                        <?php for ($day = 1; $day <= 31; $day++) { ?>
                            <option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
                        <?php } ?>
                    </select>

                </form>
                    <?php
                if( isset( $_POST['display_all_stock'] ) ) {
                    $year = $_POST['year'];
                    $month = $_POST['month'];
                    $day = $_POST['day'];
                    $date = $year . '-' . $month . '-' . $day;

                    ($year != '' && $month != '') ? $date : $date = date("Y-m-d");

                    /*$option = get_option('hmu_api_basic');
                    $urls = $option['basic_auth_url'].'Products/ALL?DateAdjusted='.$date.'T00:00:00&WebOnly=1';*/


                    $output_1 = $insert_stock->hmu_get_stock($date, false);
                    echo $output_1;
                }
                    ?>
        <!-- ===========================================================================================================

                Cron tag - add and delete crons

        =============================================================================================================-->
			<?php elseif ($active_tab == 'cron'): ?>
                <h1>Cron</h1>

                <form method="post" class="hmu-general-form" action="options.php">
					<?php
					settings_fields( 'hmu_api_dashboard_third_group' );
					do_settings_sections( 'hmu_api_cron' );
					submit_button( 'Save Settings', 'hmu-btn hmu-primary', 'btnSubmit' );
					?>

                </form>
                <hr>

                <form method="POST" action="">
                    <input class="hmu-input hmu-delete" name="delete_cron" type="submit" value="Delete cron task">
                </form>

				<?php



				if(isset($_POST['delete_cron'])){

					$option = get_option ('hmu_api_cron');
					wp_clear_scheduled_hook( 'hmu-update-stock' );
					wp_clear_scheduled_hook( 'hmu-update-products' );

					delete_option('hmu_api_cron');
					$default = array();
					add_option('hmu_api_cron', $default);
					$output = get_option('hmu_api_cron');
					$output = array();




					echo 'Task has been deleted';

					/*if ( $option && !empty($option) ) {
						foreach ($option as $key => $value) {
							$cron_name_row = $value['cron_name'];
							$cron_name_nospace = preg_replace("/[\s_]/", "-", $cron_name_row);
							$cron_name = 'hmu-api-' . $cron_name_nospace;
							wp_clear_scheduled_hook($cron_name);

							delete_option('hmu_api_cron');

							add_option('hmu_api_cron', $default);
							$output = get_option('hmu_api_cron');
							$output = array();


							echo 'Task has been deleted';
						}
					}*/
				}






				?>
				<?php
				$option  = get_option ('hmu_api_cron');
				if( $option ):
					/*  if( $option['error'] ){
						  echo 'File couldnt be moved';
						  exit();

					  }*/


					$output ="<table class='widefat fixed' cellspacing='0'>\n\n";
					$output .= "<thead>\n\n";
					$output .= "<tr>\n\n";
					$output .= "<th > Task ID</th>";
					$output .= "<th> Task Name</th>";
					$output .= "<th> Task Schedule</th>";


					$output .= "</tr>\n\n";
					$output .= "</thead>\n\n";
					$output .= "<tbody> \n";



					foreach (@$option as $key => $value) {
						$output .= "<tr>\n";
						$output .=  "<td>" . $key . "</td>";
						$output .=  "<td>" .$value['cron_name']. "</td>";
						$output .=  "<td>" .$value['cron_time']. "</td>";
						$output .= "</tr>\n";

					}

					$output .= "</tbody> \n ";
					$output .= "\n</table>";

					echo $output;


				endif;




				?>



			<?php endif; ?>



        </div>




    </div><!-- container -->


<?php


/*function run_every_five_minutes2()
{
	wp_insert_post(array(
		'post_title' => 'inisidefu22 ',
		'post_content' => 'content',
		'post_status' => 'publish',
		'post_type' => "product",
	));
}
if ( ! get_transient( 'every_5_minutes2' ) ) {
	set_transient('every_5_minutes2', true, 1 * MINUTE_IN_SECONDS);
	run_every_five_minutes2();

	// It's better use a hook to call a function in the plugin/theme
	//add_action( 'init', 'run_every_five_minutes' );
}*/









