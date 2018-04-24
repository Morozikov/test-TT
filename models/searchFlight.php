<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Flights;
use Laravie\Parser\Xml\Reader;
use Laravie\Parser\Xml\Document;

/**
 * searchFlight represents the model behind the search form of `app\models\Flights`.
 */
class searchFlight extends Flights
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'from', 'to'], 'integer'],
            [['back', 'start', 'stop', 'adult', 'child', 'infant'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Flights::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'from' => $this->from,
            'to' => $this->to,
            'start' => $this->start,
            'stop' => $this->stop,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'back', $this->back])
            ->andFilterWhere(['like', 'adult', $this->adult])
            ->andFilterWhere(['like', 'child', $this->child])
            ->andFilterWhere(['like', 'infant', $this->infant]);

        return $dataProvider;
    }




    public function send_and_save()
    {
            $xml = simplexml_load_file(\Yii::getAlias('@webroot').'/task.xml');
            $json  = json_encode($xml);
            $configData = json_decode($json, true);
            $adult_count = 0;
            $infant_count = 0;
            $child_count = 0;


            foreach ($configData['ShopOptions'] as $ShopOptions) {
                $ItineraryOptions  = $ShopOptions['ShopOption']['ItineraryOptions']['ItineraryOption'];
                $FareInfo = $ShopOptions['ShopOption']['FareInfo']['Fares']['Fare'];

                $total_price = $ShopOptions['ShopOption']['@attributes']['Total'];

                foreach ($FareInfo as $FareInfo) {
                   switch ($FareInfo['PaxType']['@attributes']['AgeCat']) {
                        case 'ADT':
                            $adult_count = $FareInfo['PaxType']['@attributes']['Count'];
                            break;

                        case 'INF':
                            $infant_count = $FareInfo['PaxType']['@attributes']['Count'];
                            break;

                        case 'CLD':
                            $child_count = $FareInfo['PaxType']['@attributes']['Count'];
                            break;
                        
                    } 
                }
                foreach ($ItineraryOptions as $ItineraryOptions) {
                    $from = Airports::getIdByCode($ItineraryOptions['@attributes']['From']);
                    $to = Airports::getIdByCode($ItineraryOptions['@attributes']['To']);
                     $FlightSegment = $ItineraryOptions['FlightSegment'];
                    $start = explode('+', $FlightSegment[0]['Departure']['@attributes']['Time']);
                    $stop = explode('+', $FlightSegment[count($FlightSegment)-1]['Arrival']['@attributes']['Time']);
                   if($ItineraryOptions['@attributes']['ODRef']=='01'){
                    $back = 0; 
                   }else
                   {
                    $back = 1; 
                   }
                    $start = date_create($start[0]);

                   $start = date_format($start, 'Y-m-d H:i:s');
                   $stop = date_create($stop[0]);

                   $stop = date_format($stop, 'Y-m-d H:i:s');

                   echo "from:".$from;
                   echo "to:".$to;
                   echo "back:".$back;
                   echo "start:".$start;
                   echo "stop:".$stop;
                   echo "adult:".$adult_count;
                   echo "child:".$child_count;
                   echo "infant:".$infant_count;
                   echo "price:".$total_price;
                   echo "<br>";  

                   $model = new Flights();
                   $model->from = $from;
                   $model->to = $to;
                   $model->back = $back;
                   $model->start = $start;
                   $model->stop = $stop;
                   $model->adult = $adult_count;
                   $model->child = $child_count;
                   $model->infant = $infant_count;
                   $model->price = $total_price;
                   $model->save(false);
                }
               
            }
          
        
    }

}
