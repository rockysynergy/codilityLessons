class MaxSliceSum {
    public int solution(int[] A) {
        int tMax = A.length > 0 ? A[0] : 0;
        int fMax = tMax;

        for (int i = 1; i < A.length; i++) {
            tMax = tMax < 0 ? 0 : tMax;
            tMax += A[i];

            if (tMax > fMax) {
                fMax = tMax;
            } 
        }

        return fMax;
    }

    public static void main(String[] args) {
        int[] a = new int[]{3, 2, -6, 4, 0};

        MaxSliceSum s = new MaxSliceSum();
        System.out.println(s.solution(a));
    }
}