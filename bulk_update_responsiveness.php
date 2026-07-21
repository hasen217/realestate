<?php
$listing_files = [
    'ballarip/cowlbazaar.php', 'ballarip/cantonment.php', 'ballarip/gandinagar.php', 'ballarip/vidyanagar.php',
    'sandur/Ballariroad.php', 'sandur/hospetroad.php', 'sandur/kampliroad.php', 'sandur/kudligiroad.php', 'sandur/torangalroad.php',
    'siruguppa/adoniroad.php', 'siruguppa/Ballariroad.php', 'siruguppa/deshnurroad.php', 'siruguppa/moulan azad school.php', 'siruguppa/sindhanurroad.php',
    'kampli/ballari road.php', 'kampli/bus stan.php', 'kampli/gangavati road.php', 'kampli/hospet road.php', 'kampli/siruguppa road.php',
    'kurugodu/badanahattiroad.php', 'kurugodu/basapuraroad.php', 'kurugodu/genekehalroad.php', 'kurugodu/sindigeriroad.php', 'kurugodu/ujjalpet.php',
    'ballarip/ballari.php', 'siruguppa/siruguppa.php', 'sandur/sandur.php', 'kampli/kampli.php', 'kurugodu/kurugodu.php'
];

$form_files = [
    'ballarip/ballariform.php', 'kurugodu/kurugoduform.php', 'kampli/kampliform.php', 'sandur/sandurform.php', 'siruguppa/formsirguguppa.php',
    'realestateadmin.php'
];

// 1. Update Listing & Main Pages
foreach ($listing_files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $new_css = "
        @media (max-width: 992px) {
            .properties, .teamm { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
            h1, .section-image h2 { font-size: 2.2rem; }
        }
        @media (max-width: 768px) {
            nav { flex-direction: column; height: auto; padding: 20px 15px; gap: 15px; }
            .nav-links, .nav-actions { width: 100%; gap: 15px; justify-content: center; flex-direction: column; }
            .nav-links a { width: 100%; text-align: center; }
            .serch, .button { width: 100% !important; margin: 0; }
            h1 { font-size: 1.8rem; text-align: center; }
            .section-image { height: 50vh; min-height: 350px; }
            .section-image h2 { font-size: 2rem; }
            .map-container iframe { height: 300px; }
            .teamm { flex-direction: column; align-items: center; }
            .team1 { width: 90% !important; }
        }";
        $content = str_replace('</style>', $new_css . "\n</style>", $content);
        file_put_contents($file, $content);
        echo "Updated: $file\n";
    }
}

// 2. Update Booking & Admin Forms
foreach ($form_files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $form_css = "
        @media (max-width: 768px) {
            body { padding: 15px; }
            .container, .login-container { padding: 30px 20px; width: 95%; }
            h2, h1 { font-size: 1.8rem; }
            .btn, .login-btn { padding: 12px; }
        }";
        $content = str_replace('</style>', $form_css . "\n</style>", $content);
        file_put_contents($file, $content);
        echo "Updated Form: $file\n";
    }
}
?>
