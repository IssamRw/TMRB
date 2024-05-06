<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="calander.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Calendrier 
                            </a>
                            <a class="nav-link collapsed" href="#"
                            data-bs-toggle="collapse"
                             data-bs-target="#collapseFichier" aria-expanded="false" aria-controls="collapseFichier">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                             Les fichies necessaire
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseFichier" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="download-file.php">View Fichier</a>
                                            <a class="nav-link" href="inde.php">Add Fichier</a>
                
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#"
                            data-bs-toggle="collapse"
                             data-bs-target="#collapseValider" aria-expanded="false" aria-controls="collapseValider">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Les Projet Valider
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseValider" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="projet-valider.php">View Validation</a>
                                            
                
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#"
                            data-bs-toggle="collapse"
                             data-bs-target="#collapseProject" aria-expanded="false" aria-controls="collapseProject">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                             Projet
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProject" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="projet.php">View Projet</a>
                                            <a class="nav-link" href="projet-create.php">Add Projet</a>
                                </nav>
                            </div>



                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages2" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                               Dossier
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                               </a>
                               <div class="collapse" id="collapsePages2" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages2">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseAdministratif"
                                     aria-expanded="false" aria-controls="collapseAdministratif">
                                    Dossier Administratif
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseAdministratif" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages2">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="add-fichier.php">View dossier</a>
                                          
                                    
                                            
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseDossier" 
                                    aria-expanded="false" aria-controls="collapseDossier">
                                    Dossier Financier
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseDossier" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages2">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="financier.php">View dossier</a>
                                            <a class="nav-link" href="financier-create.php">Add dossier</a>
                                            
                                           
                                        </nav>
                                    </div>
                                </nav>
                            </div>



                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                               Categorie & Produit
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                               </a>
                               <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseCategorie"
                                     aria-expanded="false" aria-controls="collapseCategorie">
                                    Categorie
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseCategorie" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="categorie.php">View Categorie</a>
                                            <a class="nav-link" href="categorie-create.php">Create Categorie</a>
                                    
                                            
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseProduit" 
                                    aria-expanded="false" aria-controls="collapseProduit">
                                    Produit
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseProduit" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="produit.php">View Produit</a>
                                            <a class="nav-link" href="produit-add.php">Add Produit</a>
                                            
                                           
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Gérer l'utilisateur</div>

                            <a class="nav-link collapsed" href="#"
                             data-bs-toggle="collapse" 
                             data-bs-target="#collapseAdmins"
                              aria-expanded="false" 
                              aria-controls="collapseAdmins">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                               Admins/staff
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="admins-create.php">Add Admin</a>
                                    <a class="nav-link" href="admins.php">View Admins</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                 
                </nav>
            </div>
