
                    <li class="tm-nav-item<?php active_if('index') ?>"><a href="<?php echo cs_var('url');?>" class="tm-nav-link">
                        <i class="fas fa-home"></i>
                        Home
                    </a></li>
                    <li class="tm-nav-item"><a href="javascript: $('.above-footer')[0].scrollIntoView(); $('.navbar-toggler').trigger('click');" class="tm-nav-link">
                        <i class="fas fa fa-clipboard-list"></i>
                        Go To Menu
                    </a></li>
                    <div class="holds-menu-contents"></div>
                    <li style="list-style-type: none; padding-bottom: 20px;">
                    <form action="<?php echo replace_vars('%url%go/share/') ?>" target="_blank">
                        <input type="hidden" name="url" value="<?php echo $_SERVER['SERVER_NAME'] . explode('?', $_SERVER['REQUEST_URI'], 2)[0]; ?>" />
                        <input type="submit" class="fas fa fa-share" value="Share This Page" />
                        <input type="text" name="by" placeholder="your name" />
                        <input type="text" name="campaign" placeholder="campaign (if known)" />
                    </form>
                    </li>
