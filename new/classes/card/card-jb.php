<?php
// Déclaration de classe
class Card {

    // --------------------
    // ATTRIBUTS
    // --------------------

    private $_id;
    private $_name;
    private $_mana;
    private $_pv;
    private $_atk;
    private $_desc;
    private $_type;
    private $_fx;
    private $_special;
    private $_img;

    // --------------------
    // METHODES
    // --------------------

    /**
     * Get the value of _id
     */
    public
    function get_id() {
        return $this->_id;
    }

    /**
     * Set the value of _id
     *
     * @return  self
     */
    public
    function set_id($_id) {
        $this->_id = $_id;

        return $this;
    }

    /**
     * Get the value of _name
     */
    public
    function get_name() {
        return $this->_name;
    }

    /**
     * Set the value of _name
     *
     * @return  self
     */
    public
    function set_name($_name) {
        $this->_name = $_name;

        return $this;
    }

    /**
     * Get the value of _mana
     */
    public
    function get_mana() {
        return $this->_mana;
    }

    /**
     * Set the value of _mana
     *
     * @return  self
     */
    public
    function set_mana($_mana) {
        $this->_mana = $_mana;

        return $this;
    }

    /**
     * Get the value of _pv
     */
    public
    function get_pv() {
        return $this->_pv;
    }

    /**
     * Set the value of _pv
     *
     * @return  self
     */
    public
    function set_pv($_pv) {
        $this->_pv = $_pv;

        return $this;
    }

    /**
     * Get the value of _atk
     */
    public
    function get_atk() {
        return $this->_atk;
    }

    /**
     * Set the value of _atk
     *
     * @return  self
     */
    public
    function set_atk($_atk) {
        $this->_atk = $_atk;

        return $this;
    }

    /**
     * Get the value of _desc
     */
    public
    function get_desc() {
        return $this->_desc;
    }

    /**
     * Set the value of _desc
     *
     * @return  self
     */
    public
    function set_desc($_desc) {
        $this->_desc = $_desc;

        return $this;
    }

    /**
     * Get the value of _type
     */
    public
    function get_type() {
        return $this->_type;
    }

    /**
     * Set the value of _type
     *
     * @return  self
     */
    public
    function set_type($_type) {
        $this->_type = $_type;

        return $this;
    }

    /**
     * Get the value of _fx
     */
    public
    function get_fx() {
        return $this->_fx;
    }

    /**
     * Set the value of _fx
     *
     * @return  self
     */
    public
    function set_fx($_fx) {
        $this->_fx = $_fx;

        return $this;
    }

    /**
     * Get the value of _special
     */
    public
    function get_special() {
        return $this->_special;
    }

    /**
     * Set the value of _special
     *
     * @return  self
     */
    public
    function set_special($_special) {
        $this->_special = $_special;

        return $this;
    }

    /**
     * Get the value of _img
     */
    public
    function get_img() {
        return $this->_img;
    }

    /**
     * Set the value of _img
     *
     * @return  self
     */
    public
    function set_img($_img) {
        $this->_img = $_img;

        return $this;
    }

    /**
     * Construction
     *
     * @param array $datas
     */
    public
    function __construct(array $datas) {
        $this->hydrate($datas);
    }

    /**
     * Hydratation
     *
     * @param array $datas
     * @return void
     */
    private
    function hydrate(array $datas) {
        foreach($datas as $key => $value) {
            $method = 'set'.substr($key, 4);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    public function render() {
        return 
            '<div class="card-view">'.
                '<div class="card-inner">'.
                    '<div class="card-layer background-layer"></div>'.
                    '<div class="card-layer image-layer">'.
                        '<picture src="" alt="" sizes="" srcset="">'.
                            '<img src="'; echo $this->get_img() ;'" alt="" class="fallback">'.
                        '</picture>'.
                    '</div>'.
                    '<div class="card-layer icons-layer">'.
                        '<div class="card-icon card-cost">'.
                            '<span class="icon"></span>'.
                            '<span class="value">'; echo $this->get_mana() ;'</span>'.
                        '</div>'.
                        '<div class="card-icon card-atk">'.
                            '<span class="icon"></span>'.
                            '<span class="value">'; echo $this->get_atk() ;'</span>'.
                        '</div>'.
                        '<div class="card-icon card-hp">'.
                            '<span class="icon"></span>'.
                            '<span class="value">'; echo $this->get_pv() ;'</span>'.
                        '</div>'.
                    '</div>'.
                    '<div class="card-layer text-layer">'.
                        '<div class="card-type">'; echo $this->get_type() ;'</div>'.
                        '<div class="card-title">'; echo $this->get_name() ;'</div>'.
                        '<div class="card-desc">'; echo $this->get_desc() ;'</div>
                    </div>
                    <div class="card-layer foreground-layer">
                        <div class="card-fx"></div>
                    </div>
                </div>
            </div>';
    }
}