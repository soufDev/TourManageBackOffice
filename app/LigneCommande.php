<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model {

    //

    protected $table = 'lignecommande';


    protected $fillable = [
        'id',
        'idProduit',
        'idCommande',
        'quantiteCmd',
        'quantiteLivree',
        'PrixHT',
        'PrixTTC',
        'totalPrixHT',
        'totalPrixTTC',
        'tauxRemise',
        'MontantRemise',
        'commentaire',
        'QuantiteCmd',
        'quantiteLivree',
        'quantite_livree_reel',
        'statut'];



    public function getKeyName(){
        return 'id';
    }

    public $timestamps = false;


}

