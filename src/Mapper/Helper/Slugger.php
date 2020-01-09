<?php

namespace App\Mapper\Helper;

class Slugger
{
    public function transform(string $raw): string
    {
        $delimiter = '-';
        $slug =
            strtolower(
                trim(
                    preg_replace('/[\s-]+/', $delimiter,
                        preg_replace('/[^A-Za-z0-9-]+/', $delimiter,
                            preg_replace('/[&]/', 'en',
                                preg_replace('/[@]/', 'at',
                                    preg_replace('/[\']/', '',
                                        iconv('UTF-8', 'ASCII//TRANSLIT', $raw)
                                    )
                                )
                            )
                        )
                    ),
                    $delimiter
                )
            );

        return $slug;
    }
}
