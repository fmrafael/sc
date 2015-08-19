<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2014 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    // meta tag robots
    osc_add_hook('header','osclasswizards_nofollow_construct');

    osclasswizards_add_body_class('contact');
	
	
    osc_enqueue_script('jquery-validate');
    osc_current_web_theme_path('header.php');
?>

<div class="row">
  <div class="col-md-4 col-md-offset-1">

      <div class="title">
        <p class="lead text-center"><strong>
          <?php _e('Contate-nos!'); ?>
      
     
          <?php _e('Um especialista irá apoiá-lo'); ?>
     
      </div>
      <div class="wraps">
      <div class="resp-wrapper">
        <ul id="error_list">
        </ul>
        <form name="contact_form" action="<?php echo osc_base_url(true); ?>" method="post" >
          <input type="hidden" name="page" value="contact" />

          <input type="hidden" name="action" value="contact_post" />
          <div class="form-group">
            <label class="control-label" for="yourName">
              <?php _e('Your name', OSCLASSWIZARDS_THEME_FOLDER); ?>
              </label>
            <div class="controls">
              <?php ContactForm::your_name(); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="yourEmail">
              <?php _e('Your email address', OSCLASSWIZARDS_THEME_FOLDER); ?>
            </label>
            <div class="controls">
              <?php ContactForm::your_email(); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="subject">Solicitação
              <select name="subject">
                <option value="Agendamento">Agendamento de Vistoria</option>
                <option value="Agendamento">Transferência de CRV / Compra e venda</option>
                </select> 

              </label>  
           
          </div>
          <div class="form-group">
            <label class="control-label" for="message">
              <?php _e('Message', OSCLASSWIZARDS_THEME_FOLDER); ?>
            </label>
            <div class="controls textarea">

              <?php ContactForm::your_message(); ?>
            </div>
          </div>
          <div class="form-group">
            <div class="controls">
              <?php osc_run_hook('contact_form'); ?>
              <?php osc_show_recaptcha(); ?>
              <button type="submit" class="btn btn-success">
              <?php _e("Send", OSCLASSWIZARDS_THEME_FOLDER);?>
              </button>
              <?php osc_run_hook('admin_contact_form'); ?>
            </div>
          </div>
        </form>
        <?php ContactForm::js_validation(); ?>
      </div>
</div>
  </div>
<div class="col-md-7">

        <p class="lead text">A compra de um carro usado pode ser um desafio. Mas podemos ajudar. Vistoria agendada de mais de 150 itens.  Saiba exatamente o estado do carro e os eventuais custos de reparo para uma melhor negociação. Além disso, damos todo o suporte na transferência do CRV, para sua segurança e comodidade.</p>
          
  
    <div class="imageClip">
    
         <?php echo '<img src="'.osc_current_web_theme_url('images/inspection.jpg').'"/>'; ?></div>
         <p>*Para facilitar o processo, informe o id do veículo localizado no canto superior esquerdo do anúncio.</p>
       </div>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>
