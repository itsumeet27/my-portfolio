<?php 
    include('includes/header.php'); 
    include('includes/init.php');
?>
    <div class="container-fluid pb-5">
        <div class="page-title px-2 pb-1 pt-4">
            <h1 class="p-2">RESUME <hr></h1>        
        </div>
        <div class="resume px-2 py-2">
            <div class="mt-3 row mx-0">
                <!-- Education -->
                <div class="education col-md-6">
                    <h4 class="py-4"><i class="fas fa-university"></i> &nbsp;Education</h4>
                    <div class="p-2" style="height: 480px;overflow-y: scroll; scroll-behaviour: smooth">
                        <?php
                            $education = "SELECT * FROM education ORDER BY id ASC";
                            $result_education = $db->query($education);
                            if(mysqli_num_rows($result_education) > 0){
                                while($educate = mysqli_fetch_assoc($result_education)){
                        ?>
                        <div class="left-pane pb-0">
                            <h5 class=""><?=$educate['degree_name'];?>&nbsp;&nbsp;(<?=$educate['result'];?>)</h5>
                            <p class=""><?=$educate['year_of_education'];?></p>
                            <p class=""><i><?=$educate['college_name'];?>, <?=$educate['board_university'];?></i></p>
                            <p class=""><?=$educate['short_description'];?></p>
                            <p><?=nl2br($educate['long_description']);?></p>
                        </div>
                        <?php } } else { echo "<div class='alert alert-danger'>No data to display</div>"; } ?>
                    </div>
                </div>

                <!-- Work Experience -->
                <div class="experience col-md-6">
                    <h4 class="py-4"><i class="fas fa-briefcase"></i> &nbsp;Work Experience</h4>
                    <div class="p-2" style="height: 480px;overflow-y: scroll; scroll-behaviour: smooth">
                        <?php
                            $experience = "SELECT * FROM experience ORDER BY id ASC";
                            $result_experience = $db->query($experience);
                            if(mysqli_num_rows($result_experience) > 0){
                                while($work = mysqli_fetch_assoc($result_experience)){
                        ?>
                        <div class="left-pane pb-0">
                            <h5 class=""><?=$work['designation'];?></h5>
                            <p class=""><?=$work['year_of_work'];?></p>
                            <p class=""><i><?=$work['company_name'];?></i></p>
                            <p class=""><?=nl2br($work['long_description']);?></p>
                        </div>
                        <?php } } else { echo "<div class='alert alert-danger'>No data to display</div>"; } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Skills & Certifications -->
        <div class="page-title px-2 pt-3 pb-1">
            <h3 class="p-2"><i class="fas fa-laptop"></i> &nbsp;SKILLS & CERTIFICATIONS<hr></h3>        
        </div>
        <div class="skills px-2 py-2">
            <div class="row">
                <!-- Skills -->
                <div class="experience col-md-6 px-4">  
                    <h4 class="py-4"><i class="fas fa-user-cog"></i> &nbsp;Skills</h4>
                        <div class="p-2" style="height: 480px;overflow-y: scroll; scroll-behaviour: smooth">
                        <?php
                            $skills = "SELECT * FROM skills ORDER BY id ASC";
                            $result_skills = $db->query($skills);
                            if(mysqli_num_rows($result_skills) > 0){
                                while($skill = mysqli_fetch_assoc($result_skills)){
                        ?>
                        <div class="left-pane pb-0 mb-4">
                            <p class=""><?=$skill['name'];?></p>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" style="width: <?=$skill['percentage'];?>%;" aria-valuenow="<?=$skill['percentage'];?>" aria-valuemin="0" aria-valuemax="100"><?=$skill['percentage'];?>%</div>
                            </div>
                        </div>
                        <?php } } else { echo "<div class='alert alert-danger'>No skills added yet to display</div>"; } ?>
                    </div>
                </div>

                <!-- Certifications -->
                <div class="experience col-md-6 px-4">
                    <h4 class="py-4"><i class="fas fa-certificate"></i> &nbsp;Certifications</h4>
                    <div class="p-2" style="height: 480px;overflow-y: scroll; scroll-behaviour: smooth">
                        <?php
                            $certifications = "SELECT * FROM certifications ORDER BY id ASC";
                            $result_certifications = $db->query($certifications);
                            if(mysqli_num_rows($result_certifications) > 0){
                                while($certificate = mysqli_fetch_assoc($result_certifications)){
                        ?>
                        <div class="left-pane pb-0">
                            <h5><?=$certificate['cert_name'];?></h5>
                            <p><label>Issued by:&nbsp;</label><span><i><?=$certificate['issued_by'];?></i></span></p>
                            <p><label>Date:&nbsp;</label><span><?=$certificate['issued_date'];?></span></p>
                        </div>
                        <?php } } else { echo "<div class='alert alert-danger'>No certifications added yet to display</div>"; } ?>
                    </div>
                </div>
            </div>            
        </div>
        <!-- Projects -->
        <div class="page-title px-2 pt-3 pb-1">
            <h3 class="p-2"><i class="fas fa-tasks"></i> &nbsp;PROJECTS <hr></h3>        
        </div>
        <div class="mt-3 row px-2 mx-0">   
            <!-- Associated with companies -->
            <div class="experience col-md-6">
                <h4 class="py-4"><i class="fas fa-briefcase"></i> &nbsp;Associated with companies</h4>
                <div class="p-2" style="height: 480px;overflow-y: scroll; scroll-behaviour: smooth">
                    <?php 
                        $projects = "SELECT * FROM projects WHERE associated_with <> 'Self'";
                        $run_projects = $db->query($projects);
                        if(mysqli_num_rows($run_projects) > 0){
                            while($row_projects = mysqli_fetch_assoc($run_projects)){

                    ?>
                    <div class="left-pane pb-0">
                        <h5 class="mb-3"><?=$row_projects['name']; ?></h5>
                        <p><label>Associated with:&nbsp;</label><span><?=$row_projects['associated_with']; ?></span></p>
                        <p><label>Status:&nbsp;</label><span><?=$row_projects['status']; ?></span></p>
                        <p><label>Description:&nbsp;</label></p>
                        <p><?=nl2br($row_projects['description']); ?></p>
                        <p><label>Technologies:&nbsp;</label><span><?=$row_projects['technologies']; ?></span></p>
                    </div>
                    <?php } } else { echo "<div class='alert alert-danger'>No data to display</div>"; } ?>
                </div>
            </div>

            <!-- Associated with self -->
            <div class="experience col-md-6">
                <h4 class="py-4"><i class="fas fa-briefcase"></i> &nbsp;Websites developed</h4>
                <div class="p-2" style="height: 480px;overflow-y: scroll; scroll-behaviour: smooth">
                    <?php 
                        $websites = "SELECT * FROM projects WHERE associated_with = 'Self'";
                        $run_websites = $db->query($websites);
                        if(mysqli_num_rows($run_websites) > 0){
                            while($row_websites = mysqli_fetch_assoc($run_websites)){

                    ?>
                    <div class="left-pane pb-0">
                        <h5 class="mb-3"><?=$row_websites['name']; ?></h5>
                        <p><label>Associated with:&nbsp;</label><span><?=$row_websites['associated_with']; ?></span></p>
                        <p><label>Status:&nbsp;</label><span><?=$row_websites['status']; ?></span></p>                    
                        <p><label>Category:&nbsp;</label><?=$row_websites['category']; ?></p>
                        <p><label>Description:&nbsp;</label></p>
                        <p><?=nl2br($row_websites['description']); ?></p>
                        <p><label>Technologies:&nbsp;</label><span><?=$row_websites['technologies']; ?></span></p>
                        <p><label>URL:&nbsp;</label><span><a href="<?=$row_websites['url']; ?>"><?=$row_websites['url']; ?></a></span></p>
                    </div>
                    <?php } } else { echo "<div class='alert alert-danger'>No data to display</div>"; } ?>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?>