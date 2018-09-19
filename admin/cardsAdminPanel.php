<?php
    //system de modification de carte à terminer

    session_start();

    define('ROOT_PATH', dirname(__DIR__) . '/');

    require_once( ROOT_PATH . '_db/dataBase.php' );
    //émule la bdd via un fichier
    $DBPath = ROOT_PATH . '_db/cards.json';
    
    $cards = readDBFile($DBPath);
    if( !isset( $cards )) {
        $cards = [];
    }
    if( !isset( $_SESSION['hfvp'] ) ) {
        $_SESSION['hfvp'] = [];
    }
    if( !isset( $_SESSION['hfvp']['acp'] ) ) {
        $_SESSION['hfvp']['acp'] = [];
    }
    if( !isset( $_SESSION['hfvp']['acp']['lastSubmittedCard'] ) ) {
        $_SESSION['hfvp']['acp']['lastSubmittedCard'] = '';
    }
    // var_dump($cards);
    // var_dump($cards[0]);
    if( isset($_POST['addCard'])) {
        if( isset($_POST['name'], $_POST['cost'], $_POST['desc'], $_FILES['img'], $_POST['type']) ) {
            $submittedCard = md5( $_POST['name'] . $_POST['cost'] . $_POST['desc'] . $_FILES['img']['name'] . $_POST['type'] );
            if( $submittedCard !== $_SESSION['hfvp']['acp']['lastSubmittedCard'] ) {
                var_dump($submittedCard);
                var_dump($_SESSION['hfvp']['acp']['lastSubmittedCard']);
                if( is_string($_POST['name']) && !empty($_POST['name']) ) {
                    //vérifie que le cout en mana est un entier et non vide
                    if( ctype_digit($_POST['cost']) && !empty($_POST['cost']) ) {
                        if( is_string($_POST['desc']) && !empty($_POST['desc']) ) {
                            //vérifie que l'image est valide ainsi que son type jpeg ou png
                            if( is_string($_FILES['img']['name']) && ($_FILES['img']['type'] === 'image/jpeg' || $_FILES['img']['type'] === 'image/png'  ) ) {
                                //crée un path pour l'image de la nouvelle carte
                                $tmp_name = $_FILES['img']['tmp_name'];
                                $cardsImagesPath = ROOT_PATH . 'assets/images/' . basename($_FILES['img']['name']);
                                if( is_string($_POST['type']) && !empty($_POST['type']) ) {

                                    require_once( ROOT_PATH . 'classModels/CardModels.php' );
                                    //vérifie que le type de carte est spell
                                    if ( $_POST['type'] === 'spell' ) {
                                        if ( isset($_POST['effect']) && !empty( $_POST['effect']) && is_string($_POST['effect']) ) {
                                            $newCard = new Spell( $_POST['name'], $cardsImagesPath, $_POST['desc'], $_POST['cost'], $_POST['effect'] );
                                        } else $err = 'Effet de sort invalide';

                                    //vérifie que le type de carte est creature ou shield
                                    }else if( $_POST['type'] === 'creature' || $_POST['type'] === 'shield' ) {

                                        //vérifie que les stats de la carte sont valides
                                        if ( isset($_POST['atk'], $_POST['hp'] ) && !empty( $_POST['atk'] ) && !empty( $_POST['hp'] ) && ctype_digit($_POST['atk']) && ctype_digit($_POST['hp']) ) {
                                            switch( $_POST['type'] ) {
                                                case 'creature':
                                                    //Creature( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardSpecial, $cardAtk, $cardHp )
                                                    $newCard = new Creature( $_POST['name'], $cardsImagesPath, $_POST['desc'], $_POST['cost'], false, $_POST['atk'], $_POST['hp'] );
                                                break;
                                                case 'shield':
                                                    //Shield( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardSpecial = shield, $cardAtk, $cardHp )
                                                    $newCard = new Shield( $_POST['name'], $cardsImagesPath, $_POST['desc'], $_POST['cost'], $_POST['atk'], $_POST['hp'] );
                                                break;
                                            }
                                        } else $err = 'Stats de la carte invalides.';

                                    //vérifie que le type de carte est special
                                    }else if( $_POST['type'] === 'special' ) {
                                        //vérifie que les stats de la carte sont valides
                                        if ( isset($_POST['atk'], $_POST['hp'] ) && !empty( $_POST['atk'] ) && !empty( $_POST['hp'] ) && ctype_digit($_POST['atk']) && ctype_digit($_POST['hp']) ) {
                                            //Special( $cardName, $cardImg, $cardDesc, $cardManaCost, $cardAtk, $cardHp )
                                            $newCard = new Special( $_POST['name'], $cardsImagesPath, $_POST['desc'], $_POST['cost'], $_POST['atk'], $_POST['hp'] );
                                        } else $err = 'Stats de la carte invalides.';

                                    }//Si aucun des type listés ci-dessus 
                                    else $err = 'Type de carte non reconnu.';

                                    //déplace l'image dans le dossier correspondant
                                    move_uploaded_file($tmp_name, $cardsImagesPath);
                                    
                                    

                                    //procède differemment en fonction de l'état de la bdd
                                    if( count((array)$cards) > 0 ) {
                                        //si des cartes sont déjà présentent en bdd
                                        if( $newCard ) {
                                            writeDBFile($DBPath, array_merge( $cards, array($newCard->getCardInfo()) ) );
                                            $_SESSION['hfvp']['acp']['lastSubmittedCard'] = md5( $_POST['name'] . $_POST['cost'] . $_POST['desc'] . $_FILES['img']['name'] . $_POST['type'] );
                                        }else $err = 'Error while trying to write to the card database.';
                                        //si bdd de carte vide
                                    } else if( $newCard ) {
                                        //crée la première entrée
                                        writeDBFile( $DBPath, [$newCard->getCardInfo()] );
                                        $_SESSION['hfvp']['acp']['lastSubmittedCard'] = md5( $_POST['name'] . $_POST['cost'] . $_POST['desc'] . $_FILES['img']['name'] . $_POST['type'] );
                                    } else $err = 'Error while trying to write to the card database.';
                                    //Reload Card List after inserting $newCard
                                    unset($_POST);
                                    $cards = readDBFile($DBPath);

                                } else $err ="Type de carte invalide";

                            } else $err ="Image invalide";

                        } else $err ="Description invalide";

                    } else $err ="Cout en mana invalide.";

                } else $err ="Nom de carte invalide.";
            }else $err = "";

        } else $err = "Champs manquants.";
    } 

    /**
     * function sortCards permet de trier les cartes du jeu selon leur type créature, sort et etc.
     * @param array $cardsList tableau contenant les cartes à trier
     * @return array $cardsType tableau contenant les cartes triés
     */
    function sortCards( Array $cardsList ) : array {
        if( isset($cardsList) ) {
            //array avec les différents types de cartes
            $cardsType = [
                'creature' => [],
                'spell' => [],
                'shield' => [],
                'special' => []
            ];
            foreach( $cardsList as $pos => $card ) {
                switch( $card->type ) {
                    case 'creature':
                        if( $card->special === false ) $cardsType['creature'][] = $card;
                        elseif( $card->special === 'shield') $cardsType['shield'][] = $card;
                    break;
                    case 'spell':
                        $cardsType['spell'][] = $card;
                    break;
                    case 'special':
                        $cardsType['special'][] = $card;
                    break;
                }
            }
        }
        return $cardsType;
    }
    // var_dump( sortCards( $cards ) );
    $allSortedCards = sortCards( $cards );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/set_admin.css">
    <title>Cards Manager</title>
</head>
<body>
    <!-- <style> table{max-width: 100%} </style> -->
    <main class="main-page">
        <header class="header">
            <div class="text-lvl1">Cards Manager</div>
        </header>
        <div class="container center">
            <fieldset class="sidebar">
            <div class="deconnected text-lvl2">déconnexion</div>
                <nav class="menu text-lvl2">
                    <a href="">Ajouter Carte</a>
                    <a href="">lien2</a>
                    <a href="">lien3</a>
                    <a href="">lien4</a>
                </nav>
                <div class="news">
                    <div class="text-lvl2">lasted news</div>
                    <p class="info-text text-lvl3">
                        Pour des news toutes fraîches, yaka voir le mage... oupa
                        <div class="i-mage">
                            <img src="assets/images/mageoupapuissant.png" alt="">
                        </div>
                    </p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla, quo cumque. Reiciendis possimus similique incidunt unde consequatur nihil, non eligendi!</p>
                </div>
            </fieldset>
            <div class="box-cards ">  
                <fieldset class="add-card">
                    <div class="legend text-lvl2">- Ajouter carte -</div>
                    <form class="inside-form" enctype="multipart/form-data" action="" method="post">
                        <div class="row-1">
                            <div class="field">
                                <label for="type">Type de Carte</label>
                                <select id="type" name="type">
                                    <option value="creature">Créature</option>
                                    <option value="spell">Sort</option>
                                    <option value="shield">Bouclier</option>
                                    <option value="special">Spéciale</option>
                                </select>
                            </div>
                            <div class="field">
                                <label class="text-lvl3" for="name">Nom de la Carte</label>
                                <input id="name" name="name" type="text">
                            </div>
                            <div class="field">
                                <label class="text-lvl3" for="manaCost">Coût en Mana</label>
                                <input id="manaCost" name="cost" type="number">
                            </div>
                            <div class="field">
                                <label class="text-lvl3" for="desc">Description</label>
                                <input id="desc" name="desc" type="text">
                            </div>
                        
                            <div class="field">
                                <label class="text-lvl3" for="atk">Valeur d'attaque</label>
                                <input id="atk" name="atk" type="number">
                            </div>
                            <div class="field">
                                <label class="text-lvl3" for="hp">Points de vie</label>
                                <input id="hp" name="hp" type="number">
                            </div>
                            <div class="field">
                                <label class="text-lvl3" for="effect">Effet de sort</label>
                                <input id="effect" name="effect" type="text" disabled>
                            </div>
                        </div>
                        <div class="row-2">
                            <div class="field">
                                <label class="text-lvl3" for="img">Artwork</label>
                                <input class="text-lvl3" id="img" name="img" type="file">
                            </div>
                            <div class="field-submit">
                                <input class="text-lvl2" name="addCard" type="submit">
                            </div>
                        </div>
                    </form>
                </fieldset>
                <fieldset class="view-cards">
                    <div class="legend text-lvl2">- Collection carte -</div>
                    <?php
                        //display error if there's any
                        if(isset($err)) print_r($err);
                        if( isset($allSortedCards) && !empty($allSortedCards) ) {
                            // var_dump($allSortedCards);
                            foreach( $allSortedCards as $cardsType => $cardsLists ) {
                                $table = '';
                                $table .= "
                                <div class='table'>
                                    <h2 class='text-lvl2'> $cardsType </h2>
                                    <table>
                                        <thead>
                                            <tr>
                                ";             
                                            if( isset( $cardsLists ) && !empty( $cardsLists ) ) {
                                                $table .= "<th> ID </th>";
                                                foreach( array_keys((array)$cardsLists[0]) as $cardPropsName ) {
                                                    if( $cardPropsName !== 'type' )
                                                        $table .= "<th> $cardPropsName </th>";
                                                }
                                $table .=           "<th>Edit</th>
                                                    <th>Delete</th>";
                                            }
                                $table .= "
                                            </tr>
                                        </thead>
                                        <tbody>";
                                            if( isset( $cardsLists ) && !empty( $cardsLists ) ) {
                                                foreach( $cardsLists as $pos => $card ) {
                                                    $readablePos = $pos;
                                                    $table .= "<tr> <td class='id'>$readablePos</td>";
                                                    foreach( $card as $cardPropsName => $cardPropsValues ) {
                                                        if( $cardPropsName !== 'type' )
                                                            if( $cardPropsName !== 'special' )
                                                                $table .= "<td>$cardPropsValues</td>";
                                                            else {
                                                                if( $cardPropsValues !== false ) {
                                                                    $table .= "<td>$cardPropsValues</td>";
                                                                }else {
                                                                    $table .= "<td>aucun</td>";
                                                                }
                                                            }
                                                    }
                                                    $table .= "<td><button class='editBtn'>Edit</button></td>";
                                                    $table .= "<td><button class='deleteBtn'>Delete</button></td>";
                                                    $table .= "</tr>";
                                                }
                                            }
                                $table .= "
                                        </tbody>
                                    </table>
                                </div>
                                ";
                                echo $table;
                            }
                        }
                    ?>
                    <form action="">
                        <div class="field">
                            <button name="smb" id="smb" class="" disabled="disabled">Save Changes</button>
                        </div>
                        <div class="field">
                            <button name="rmb" id="rmb" class="" disabled="disabled">Reset Changes</button>
                        </div>
                    </form>
                </fieldset>
            </div> 
        </div>
        <script>
            'use strict';
            function getElemAttr( elem, attr ) {
                return elem.getAttribute( attr );
            }
            function setElemAttr( elem, attr, value ) {
                elem.setAttribute( attr, value );
            }
            function checkNodeName( node, type ) {
                type = type.toUpperCase();
                if(node.nodeName === type) return true;
                else return false;
            }
            document.addEventListener('DOMContentLoaded', function() {
                let cardsTables = document.querySelectorAll('body .container table'),
                    editBtns = document.querySelectorAll('.editBtn'),
                    deleteBtns = document.querySelectorAll('.deleteBtn'),
                    typeSelect = document.getElementById('type'),
                    atkInput = document.getElementById('atk'),
                    hpInput = document.getElementById('hp'),
                    saveChangesBtn =  document.getElementById('smb'),
                    resetChangesBtn =  document.getElementById('rmb'),
                    effectInput = document.getElementById('effect');

                //
                let tablesCurrentState = [], 
                    tablesPreviousState = [];
                function saveCurrentTables() {
                    tablesPreviousState = tablesCurrentState;
                    cardsTables.forEach( (table, i, tables) => {
                        tablesCurrentState[i] = table.innerHTML;
                    });
                }
                saveCurrentTables();
                // console.log(cardsTables);
                function onButtonEditClick(e) {
                    var btn = e.target, 
                        btnCell = btn.parentNode,
                        row = btn.parentNode.parentNode;

                        if( !getElemAttr( row, 'mod' ) ) {
                            
                            setElemAttr( row, 'mod', true );
                            row.childNodes.forEach( cell =>{  
                                if (cell !== btnCell && checkNodeName( cell, 'td' ) && cell.childNodes[0].nodeName !== 'BUTTON' ) {
                                    if( isNaN(Number(cell.innerText)) ) {
                                        var input = '<input value="' + cell.innerText + '" type="text">';
                                        cell.innerHTML = input;
                                    }else {
                                        var input = '<input value="' + cell.innerText + '" type="number">';
                                        cell.innerHTML = input; 
                                    }
                                }
                            });
                        } else {
                            row.removeAttribute('mod');
                            row.childNodes.forEach( cell =>{  
                                if (cell !== btnCell && checkNodeName( cell, 'td' ) && cell.childNodes[0].nodeName !== 'BUTTON' ) {
                                    cell.innerText = cell.childNodes[0].value;
                                }
                            });
                            tablesPreviousState.forEach( (table, i, tables) => {
                                // console.log(getDifference(table, cardsTables[i].innerHTML));
                                function getDifference(a, b) {
                                    var i = 0;
                                    var j = 0;
                                    var result = '';

                                    while (j < b.length) {
                                        if (a[i] != b[j] || i == a.length)
                                            result += b[j];
                                        else
                                            i++;
                                        j++;
                                    }
                                    if(result !== '') {
                                        return result;
                                    } 
                                    else {
                                        return false;
                                    }
                                }
                                if( getDifference(table, cardsTables[i].innerHTML) ) {
                                    changeButtonDisabledState(saveChangesBtn, true);
                                    changeButtonDisabledState(resetChangesBtn, true);
                                }
                            });
                        }

                }
                function onTrRepop() {
                    editBtns = document.querySelectorAll('.editBtn');
                    deleteBtns = document.querySelectorAll('.deleteBtn');
                    editBtns.forEach( btn => {
                        btn.addEventListener('click', onButtonEditClick, false);
                    });
                    deleteBtns.forEach( btn => {
                        btn.addEventListener('click', onButtonDeleteClick, false);
                    });
                }
                function onResetChangesClick(e) {
                    // console.log(e);
                    e.preventDefault();
                    cardsTables.forEach( (table, i, tables) => {
                        table.innerHTML = tablesPreviousState[i];
                    });
                    onTrRepop();
                    changeButtonDisabledState(resetChangesBtn, false);
                }
                function onSaveChangesClick(e) {
                    saveCurrentTables();
                }
                function changeButtonDisabledState( button, state ) {
                    if(state) {
                        button.removeAttribute('disabled');
                    }else {
                        setElemAttr(button, 'disabled', true);
                    }
                }
                function onButtonDeleteClick(e) {
                    var btn = e.target, 
                        btnCell = btn.parentNode,
                        row = btn.parentNode.parentNode;

                        row.parentNode.removeChild(row);
                        changeButtonDisabledState(saveChangesBtn, true);
                        changeButtonDisabledState(resetChangesBtn, true);
                }
                function onSelectValueChange(e) {
                    var selectValue = e.srcElement.value;
                    if( selectValue === 'spell' ) {
                        setElemAttr( atkInput, 'disabled', true);
                        setElemAttr( hpInput, 'disabled', true );
                        effectInput.removeAttribute('disabled');
                    }
                    if( selectValue === 'special' || selectValue === 'creature' || selectValue === 'shield' ) {
                        atkInput.removeAttribute('disabled');
                        hpInput.removeAttribute('disabled');
                        setElemAttr(effectInput, 'disabled', true);
                    }
                };
                saveChangesBtn.addEventListener('click', onSaveChangesClick, false)
                resetChangesBtn.addEventListener('click', onResetChangesClick, false)
                typeSelect.addEventListener('input', onSelectValueChange, false);

                editBtns.forEach( btn => {
                    btn.addEventListener('click', onButtonEditClick, false);
                });
                deleteBtns.forEach( btn => {
                    btn.addEventListener('click', onButtonDeleteClick, false);
                });
            });
        </script>
    </main>
</body>
</html>