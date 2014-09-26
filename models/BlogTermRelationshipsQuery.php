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
class BlogTermRelationshipsQuery extends ActiveQuery
{
    
    public function forPost($id = 0)
    {
        $this->andWhere(['post_id' => $id]);
        return $this;
    }
    
}