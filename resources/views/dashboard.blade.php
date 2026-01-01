<x-layouts.app :title="__('Dashboard')">

    <section class="overview" id="overview">
        <div class="overview_left">
            <div class="titlebar">
                <h1 style="padding-left: 10px;">Overview Dashboard</h1>
            </div>

            <!-- TOP CARDS -->
            <div class="overview_cards ">
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Skills</p>
                        <span>{{$skillCount}}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <a href="skills">View Skills</a>
                    </div>
                </div>
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Educations</p>
                        <span>{{$educationCount}}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <a href="education">View Educations</a>
                    </div>
                </div>
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Experience</p>
                        <span>{{$experienceCount}}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <a href="work">View Experiences</a>
                    </div>
                </div>

                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Projects</p>
                        <span>{{$projectCount}}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <a href="projects">View Projects</a>
                    </div>
                </div>


                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Users</p>
                        <span>{{$userCount}}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <a href="users">View Users</a>
                    </div>
                </div>


            </div>
            <!-- MEDIUM CARDS -->
            <div class="overview_table ">
                <div>
                    <div class="titlebar">
                        <h1>Latest Projects</h1>
                    </div>
                    <div class="table ui-card">
                        <div class="overview_table-header">
                            <p>Image</p>
                            <p>Product</p>
                        </div>
                        @foreach($projects as $project)
                        <div class="overview_table-items" >
                            <img src="{{asset('images/'.$project->image)}}" />
                            <a>{{$project -> title}}</a>
                        </div>
                        @endforeach



                    </div>
                </div>
                <div>



                </div>
            </div>


        </div>
        <div class="overview_right">
            <div class="table ui-card">
            <div class="titlebar">

                <h3 style="  font-size: 26px;">Skills</h3>
            </div>
            <div class="overview_skills">
                <div class="overview_skills-title">
                    <h2>Frontend developer</h2>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">HTML</h3>
                        <span class="skills_number">90%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_html"></span>
                    </div>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">CSS</h3>
                        <span class="skills_number">80%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_css"></span>
                    </div>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">JavaScript</h3>
                        <span class="skills_number">75%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_js"></span>
                    </div>
                </div>
            </div>
            <br>
            <div class="overview_skills">
                <div class="overview_skills-title">
                    <h2>Backend developer</h2>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">PHP</h3>
                        <span class="skills_number">90%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_html"></span>
                    </div>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">Node Js</h3>
                        <span class="skills_number">80%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_css"></span>
                    </div>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">Python</h3>
                        <span class="skills_number">75%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_js"></span>
                    </div>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">Ruby</h3>
                        <span class="skills_number">75%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_js"></span>
                    </div>
                </div>
            </div>
            <br>
            <div class="overview_skills">
                <div class="overview_skills-title">
                    <h2>Designer</h2>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">Figma</h3>
                        <span class="skills_number">90%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_html"></span>
                    </div>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">Sketch</h3>
                        <span class="skills_number">80%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_css"></span>
                    </div>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">Adobe XD</h3>
                        <span class="skills_number">75%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_js"></span>
                    </div>
                </div>
                <div class="skills_data">
                    <div class="skills_titles">
                        <h3 class="skills_name">Photoshop</h3>
                        <span class="skills_number">75%</span>
                    </div>
                    <div class="skills_bar">
                        <span class="skills_percentage skills_js"></span>
                    </div>
                </div>
            </div></div>
        </div>

    </section>
</x-layouts.app>
