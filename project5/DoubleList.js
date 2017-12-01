/* Doubly Linked List implementation */
/* By Anna Blendermann */

/* Node custom type */
function Node(value) {
    this.data = value;
    this.prev = null;
    this.next = null;
}

/* Doubly Linked List constructor */
function DoubleList(compFunc) {
    this.size = 0;
    this.head = null;
    this.tail = null;
    this.compare = compFunc;
}

/* add (to front) function */
DoubleList.prototype.addToFront = function(value) {
    var node = new Node(value);

    if (this.size > 0) {
        node.next = this.head;
        this.head.prev = node;
        this.tail.next = node; /* circular linked list */
        node.prev = this.tail; /* circular linked list */
        this.head = node;

    }
    else {
        this.head = node;
        this.tail = node;
        this.tail.next = node; /* circular linked list */
        this.head.prev = node; /* circular linked list */
    }
    this.size++;
    return node;
};

/* add (to end) function */
DoubleList.prototype.addToEnd = function(value) {
    var node = new Node(value);

    if (this.size > 0) {
        this.tail.next = node;
        node.prev = this.tail;
        node.next = this.head; /* circular linked list */
        this.head.prev = node; /* circular linked list */
        this.tail = node;
    }
    else {
        this.head = node;
        this.tail = node;
        this.tail.next = node; /* circular linked list */
        this.head.prev = node; /* circular linked list */
    }
    this.size++;
    return node;
};

/* insert (between elements) function */
DoubleList.prototype.insert = function(value) {
    var node = new Node(value);

    if (this.size > 0) {

        /* add to the front */
        if (this.compare(this.head, node)) {
            this.addToFront(value);
        }

        /* add to the end */
        if (this.compare(node, this.tail)) {
            this.addToEnd(value);
        }

        /* insert in the middle */
        var prev = this.head;
        var curr = this.head.next;

        while (curr !== null) {
                if (value > prev.data) {
                    prev.next = node;
                    node.prev = prev;
                    node.next = curr;
                    curr.prev = node;
                }
                prev = curr;
                curr = curr.next;
        }
    }
    else {
        this.head = node;
        this.tail = node;
    }
    this.size++;
    return node;
};

/* getSize function */
DoubleList.prototype.getSize = function() {
    return this.size;
};

/* isEmpty function */
DoubleList.prototype.isEmpty = function() {
    return (this.size === 0);
};

/* getHead function */
DoubleList.prototype.getHead = function() {
    return this.head;
};