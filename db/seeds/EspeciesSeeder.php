<?php

use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class EspeciesSeeder extends AbstractSeed
{

    const ESPECIES = [
        'Ananas comosus',
        'Euterpe oleracea',
        'Luehea divaricata',
        'Amescla',
        'Pterogyne nitens',
        'Joanesia princeps',
        'Alcantarea imperialis',
        'Symphonia Globulifera',
        'Lagenaria vulgaris',
        'Cupania racemosa',
        'Thyrsodium spruceanum',
        'Theobroma cacao',
        'Cordia ecalyculata',
        'Cordia ecalyculata',
        'Trichilia laminensis',
        'Tabernaemontana laeta',
        'Cajueiro',
        'Cajueiro-bravo-do-campo',
        'Actinostemon Lanceolatus',
        'Dioscorea alata',
        'Copernicia australis',
        'Copernicia prunifera',
        'Amaranthus viridis',
        'Pachira aquatica',
        'Calathea Lutea',
        'Equisetum',
        'Cedrela fissilis',
        'Eugenia involucrata',
        'Echinodorus grandiflorus',
        'Attalea Tessmannii',
        'Lentinus Enodes',
        'Curatella americana',
        'Arundinaria mucronata',
        'Crescentia cujete',
        'Copaifera langsdorfii',
        'Dipteryx alata',
        'Theobroma grandiflorum',
        'Digitalis purpurea',
        'Annonaceae',
        'Daphnopsis fasciculata',
        'Eschweira ovata',
        'Eriotheca candolleana',
        'Maytenus ilicifolia',
        'Hamadryas feronia',
        'Ilex paraguariensis',
        'Boraginaceae',
        'Solanum mauritianum',
        'Campomanesia xanthocarpa',
        'Eugenia leitonii',
        'Patagonula bahiensis',
        'Schizolobium parahyba',
        'Paullinia cupana',
        'Mikania glomerata',
        'Inga blanchetiana',
        'Inga uruguensis',
        'Colocasia esculenta',
        'Tabebuia alba',
        'Tabebuia roseoalba',
        'Handroanthus impetiginosus',
        'Eugenia cauliflora',
        'Dalbergia nigra',
        'Jacaranda mimosifolia',
        'Jacaratia spinosa',
        'Hymenaea courbaril',
        'Genipa americana',
        'Tocoyena sellowiana',
        'Cariniana legalis',
        'Syagrus romanzoffiana',
        'Guapira Opposita',
        'Ziziphus joazeiro',
        'Solanum paniculatum',
        'Sapium glandulatum',
        'Laurus nobilis',
        'Cyclolobium vecchi',
        'Manihot utilissima',
        'Brosimum gaudichaudii',
        'Manihot esculenta',
        'Persea pyrifolia',
        'Cydonia oblonga',
        'Zea mays',
        'Swietenia macrophylla King',
        'Senegalia polyphylla',
        'Pachira aquatica',
        'Byrsonima crassifolia',
        'Lophomyrtus',
        'Guazuma ulmifolia',
        'Orchis militaris',
        'Chorisia speciosa',
        'Cycas circinalis',
        'Euterpe edulis Martius',
        'Attalea dubia'
    ];
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Factory::create('pt_BR');
        $faker->addProvider($this);
        $categorias = $this->table('especie');
        $data = [];

        foreach(range(1,6) as $value){
            $data[] = [
                    'especie' => $faker->especiesName(),
                    'imagem' => 'especie' . $value . '.jpg',
                    'status' => 1
                ];
        }
        $categorias->insert($data)->save();
    }

    public function especiesName()
    {
        return \Faker\Provider\Base::randomElement(self::ESPECIES);
    }
}
