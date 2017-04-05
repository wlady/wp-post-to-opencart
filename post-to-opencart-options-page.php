		<div class="wrap ">
			<div id="icon-options-general" class="icon32"><br /></div>
			<h2><?php _e( 'Post To OpenCart' , 'post-to-opencart' ); ?></h2>
            <p><?php _e( 'You can find the OpenCart API key on "System > Users > API" page in Your OpenCart admin panel' , 'post-to-opencart' ); ?></p>
			<form action="options.php" method="post">
				<?php settings_fields ( 'post-to-opencart' ); ?>
				<?php if ( ! empty ( $this->options ) ) : // Start option check. Don't show most of the form if there are no options in the db ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<?php _e( 'OpenCart URL' , 'post-to-opencart' ); ?>
						</th>
						<td>
							<input type="text" name="post-to-opencart[post-to-opencart-url]" value="<?php echo $this->get_option ( 'post-to-opencart-url' ); ?>" size="100" />
						</td>
					</tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php _e( 'OpenCart API Key' , 'post-to-opencart' ); ?>
                        </th>
                        <td>
                            <textarea name="post-to-opencart[post-to-opencart-key]" rows="5" cols="100" /><?php echo $this->get_option ( 'post-to-opencart-key' ); ?></textarea>
                        </td>
                    </tr>
				</table>

				<?php endif; // End Option Check ?>

				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' , 'post-to-opencart' ) ?>" />
				</p>
			</form>
		</div>
