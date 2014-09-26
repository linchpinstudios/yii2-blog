<?php

/*
* 
*
* (c) Linchpin Studios <http://github.com/linchpinstudios/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace linchpinstudios\blog\models;

use yii\db\ActiveQuery;

/**
 * UserQuery
 *
 * @author Josh Hagel <joshhagel@linchpinstudios.com>
 */
class BlogTermsQuery extends ActiveQuery
{
    
    public function termType($type = 'category')
    {
        $this->andWhere(['type' => $type]);
        return $this;
    }
    
    
    
    
    public function random()
    {
        $this->orderBy('RAND()');
        return $this;
    }
    
}